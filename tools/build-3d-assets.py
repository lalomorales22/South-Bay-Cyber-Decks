#!/usr/bin/env python3
"""Generate GLB 3D assets for South Bay Cyber Decks.

Units: metres, Y-up, deck centred on X/Z, base top near y=0.
Regenerate with:  python3 tools/build-3d-assets.py
Output: assets/models/{cases,keyboards,displays,accessories,touchpads,builds}/
        + assets/models/manifest.json

Geometry is a clean, dimension-accurate schematic (not a fabrication
drawing): case shells, display bezels, key grids, and accessory modules
are all modelled at the sizes the configurator uses, so a GLB opened in
Blender / model-viewer matches what the live Three.js visualizer shows.
"""
import json, os, math
import numpy as np
import trimesh

ROOT = os.path.join(os.path.dirname(__file__), "..", "assets", "models")
os.makedirs(ROOT, exist_ok=True)

def mat(hexcol, metal=0.0, rough=0.6, name="m"):
    r = int(hexcol[1:3], 16) / 255; g = int(hexcol[3:5], 16) / 255; b = int(hexcol[5:7], 16) / 255
    return trimesh.visual.material.PBRMaterial(name=name, baseColorFactor=[r, g, b, 1.0],
                                               metallicFactor=float(metal), roughnessFactor=float(rough))

def box(w, h, d, colour, metal=0.0, rough=0.6, pos=(0, 0, 0), name="box"):
    m = trimesh.creation.box(extents=[w, h, d])
    m.visual.material = mat(colour, metal, rough, name)
    m.apply_translation(pos)
    return m

def cyl(r, h, colour, metal=0.0, rough=0.5, pos=(0, 0, 0), name="cyl"):
    # trimesh cylinders run along Z; rotate to Y-up
    m = trimesh.creation.cylinder(radius=r, height=h, sections=24)
    rot = trimesh.transformations.rotation_matrix(math.radians(90), [1, 0, 0])
    m.apply_transform(rot)
    m.visual.material = mat(colour, metal, rough, name)
    m.apply_translation(pos)
    return m

def sphere(r, colour, metal=0.0, rough=0.4, pos=(0, 0, 0), name="sph"):
    m = trimesh.creation.icosphere(subdivisions=2, radius=r)
    m.visual.material = mat(colour, metal, rough, name)
    m.apply_translation(pos)
    return m

def lid_transform(mesh, hinge, tilt_deg=-15):
    """Place a lid-local mesh (centred at its own origin) into deck space.
    hinge=(x,y,z) is the hinge point; mesh local +Y is lid height."""
    R = trimesh.transformations.rotation_matrix(math.radians(tilt_deg), [1, 0, 0])
    T = trimesh.transformations.translation_matrix(hinge)
    mesh.apply_transform(T @ R)
    return mesh

CASES = {
    "vintage":  dict(colour="#e8dcc0", metal=0.0, rough=0.85, w=0.34, d=0.24, label="Vintage Terminal"),
    "sleek":    dict(colour="#2b3440", metal=0.9, rough=0.35, w=0.32, d=0.22, label="Sleek"),
    "tactical": dict(colour="#5a6b3f", metal=0.2, rough=0.70, w=0.34, d=0.24, label="Tactical / Field"),
    "hidden":   dict(colour="#7a4a2b", metal=0.0, rough=0.90, w=0.32, d=0.22, label="Hidden / Stealth"),
    "exposed":  dict(colour="#3a3f45", metal=0.7, rough=0.45, w=0.32, d=0.22, label="Exposed / Cyberpunk"),
    "luggable": dict(colour="#8a8f94", metal=0.6, rough=0.50, w=0.36, d=0.26, label="Luggable"),
}
BOARDS = {
    "SB-40": [10, 10, 10, 10], "SB-50": [10, 10, 10, 10, 10], "SB-60": [14, 14, 13, 12, 8],
    "SB-65": [15, 15, 14, 13, 11], "SB-75": [16, 16, 16, 15, 14], "SB-Ortho48": [12, 12, 12, 12],
    "SB-Split36": [12, 12, 12], "SB-Type": [13, 13, 12, 11, 9], "SB-Track": [14, 14, 13, 12, 8],
    "SB-Macro": [15, 15, 14, 13, 10],
}
DISPLAYS = {"7": (0.19, 0.12), "10": (0.26, 0.16), "13": (0.32, 0.20)}

def case_meshes(family, standalone=False):
    c = CASES[family]; W, D = c["w"], c["d"]; out = []
    if family == "exposed":
        out.append(box(W, 0.012, D, "#22262b", 0.7, 0.45, (0, 0.006, 0), "frame"))
        for sx in (-1, 1):
            for sz in (-1, 1):
                out.append(cyl(0.006, 0.03, "#c98f2e", 0.9, 0.3, (sx * (W/2 - 0.015), 0.025, sz * (D/2 - 0.015)), "brass"))
        out.append(box(W - 0.06, 0.006, D - 0.06, "#0d5c2e", 0.1, 0.6, (0, 0.018, 0), "pcb"))
    else:
        out.append(box(W, 0.035, D, c["colour"], c["metal"], c["rough"], (0, 0, 0), "base"))
        out.append(box(W - 0.02, 0.006, D - 0.02, c["colour"], c["metal"], c["rough"], (0, 0.02, 0), "deck"))
    if family == "tactical":
        for sx in (-1, 1):
            for sz in (-1, 1):
                out.append(box(0.03, 0.045, 0.03, "#222222", 0.1, 0.8, (sx * (W/2 - 0.008), 0, sz * (D/2 - 0.008)), "corner"))
        out.append(box(0.12, 0.012, 0.02, "#222222", 0.1, 0.8, (0, 0.045, D/2 + 0.005), "handle"))
    if family == "hidden":
        out.append(box(W, 0.008, D, "#5a3520", 0.0, 0.9, (0, -0.02, 0), "cover"))
        out.append(box(0.012, 0.03, D - 0.01, "#f2ead6", 0.0, 0.9, (W/2 - 0.004, 0, 0), "pages"))
    if family == "luggable":
        out.append(box(0.14, 0.014, 0.02, "#222222", 0.2, 0.7, (0, 0.04, D/2 + 0.005), "handle"))
        for sx in (-1, 1):
            out.append(box(0.03, 0.015, 0.01, "#c0c0c0", 0.9, 0.3, (sx * 0.08, 0.005, D/2 + 0.002), "latch"))
    # Lid frame (empty shell, screen goes inside it in assembled builds)
    hinge = (0, 0.02, -D / 2)
    lid_w = W - 0.01; lid_h = 0.19; th = 0.012
    for part, pos in [("top", (0, lid_h - 0.008, 0)), ("bottom", (0, 0.008, 0)),
                      ("left", (-lid_w/2 + 0.008, lid_h/2, 0)), ("right", (lid_w/2 - 0.008, lid_h/2, 0))]:
        w = lid_w if part in ("top", "bottom") else 0.016
        h = 0.016 if part in ("top", "bottom") else lid_h
        m = box(w, h, th, c["colour"], c["metal"], c["rough"], pos, "lid-" + part)
        out.append(lid_transform(m, hinge))
    if standalone:
        # Recentring: standalone viewers orbit the origin, so shift up
        for m in out:
            m.apply_translation((0, 0.05, 0))
    return out

def keyboard_meshes(board, caps="chunky", touchpad="none", pos=(0, 0.024, 0.01), standalone=False):
    rows = BOARDS[board]; pitch = 0.019
    cols = max(rows); kw = cols * pitch + 0.012; kd = len(rows) * pitch + 0.012
    cap_colour = {"low": "#2a2f33", "chunky": "#1a1d20", "vintage": "#e8dcc0", "blank": "#222222"}[caps]
    split = board == "SB-Split36"
    if split:
        out = [box(kw / 2 - 0.008, 0.006, kd, "#0f1a12", 0.1, 0.6, (pos[0] - kw / 4 - 0.008, pos[1], pos[2]), "pcb-left"),
               box(kw / 2 - 0.008, 0.006, kd, "#0f1a12", 0.1, 0.6, (pos[0] + kw / 4 + 0.008, pos[1], pos[2]), "pcb-right")]
    else:
        out = [box(kw, 0.006, kd, "#0f1a12", 0.1, 0.6, (pos[0], pos[1], pos[2]), "pcb")]
    for ri, n in enumerate(rows):
        # Row 0 at the back (-Z), spacebar row at the front (+Z)
        z = pos[2] + (ri - len(rows) / 2 + 0.5) * pitch
        if split:
            halves = [(n // 2, -kw / 4 - 0.008), (n - n // 2, kw / 4 + 0.008)]
            for hn, cx in halves:
                for i in range(hn):
                    x = cx + (i - (hn - 1) / 2) * pitch
                    out.append(key_mesh(x, pos[1] + 0.008, z, caps, cap_colour))
        else:
            for i in range(n):
                is_space = ri == len(rows) - 1 and i == n // 2
                x = pos[0] + (i - (n - 1) / 2) * pitch
                if is_space:
                    out.append(box(pitch * 3.2, 0.01, pitch * 0.88, cap_colour, 0.1, 0.6, (x, pos[1] + 0.008, z), "space"))
                else:
                    out.append(key_mesh(x, pos[1] + 0.008, z, caps, cap_colour))
    # Touchpad (deck-space offsets; standalone files centre it under the keys)
    if standalone:
        tp_pos = (0, pos[1], -kd / 2 - 0.035)
    else:
        tp_pos = (kw / 2 + 0.035, pos[1], pos[2]) if touchpad == "side" else (0, pos[1], pos[2] - kd / 2 - 0.03)
    if touchpad == "side" or touchpad == "center":
        out.append(box(0.055, 0.004, 0.04, "#1c2b22", 0.2, 0.4, tp_pos, "touchpad"))
    elif touchpad == "trackball":
        out.append(sphere(0.017, "#5eead4", 0.3, 0.3, (tp_pos[0], tp_pos[1] + 0.008, tp_pos[2]), "trackball"))
    elif touchpad == "stick":
        out.append(cyl(0.004, 0.012, "#222222", 0.2, 0.6, (0, pos[1] + 0.01, pos[2]), "stick"))
    return out, kw, kd

def key_mesh(x, y, z, caps, colour):
    if caps == "vintage":
        return cyl(0.0085, 0.01, colour, 0.0, 0.7, (x, y, z), "roundcap")
    return box(0.017, 0.01, 0.017, colour, 0.1, 0.6, (x, y, z), "key")

def display_meshes(size, hinge=(0, 0.02, -0.11), standalone=False):
    w, h = DISPLAYS[size]; out = []
    if standalone:
        out.append(box(w + 0.02, h + 0.02, 0.012, "#111111", 0.4, 0.4, (0, 0, 0), "bezel"))
        out.append(box(w, h, 0.002, "#0a1f16", 0.0, 0.3, (0, 0, 0.007), "screen"))
        return out
    bez = box(w + 0.02, h + 0.02, 0.012, "#111111", 0.4, 0.4, (0, (h + 0.02) / 2, 0), "bezel")
    scr = box(w, h, 0.002, "#0a2a1c", 0.0, 0.25, (0, (h + 0.02) / 2, 0.007), "screen")
    out.append(lid_transform(bez, hinge)); out.append(lid_transform(scr, hinge))
    return out

def accessory_meshes(aid, deck_pos=None):
    """Standalone: centred at origin. Deck: placed by assemble()."""
    p = deck_pos if deck_pos is not None else (0, 0, 0)
    if aid == "esp32lcd":
        return [box(0.07, 0.02, 0.045, "#222222", 0.3, 0.5, (p[0], p[1] + 0.01, p[2]), "esp32"),
                box(0.055, 0.002, 0.032, "#0a2a1c", 0.0, 0.25, (p[0], p[1] + 0.021, p[2]), "lcd")]
    if aid == "esp32second":
        return [box(0.055, 0.014, 0.035, "#1a3a2a", 0.2, 0.5, (p[0], p[1] + 0.007, p[2]), "esp32b")]
    if aid in ("lora", "wifi"):
        return [cyl(0.003, 0.14 if aid == "lora" else 0.10, "#222222", 0.3, 0.5, (p[0], p[1] + 0.07, p[2]), "antenna"),
                sphere(0.005, "#39ff9a", 0.2, 0.4, (p[0], p[1] + 0.14 if aid == "lora" else p[1] + 0.10, p[2]), "tip")]
    if aid == "gps":
        return [cyl(0.02, 0.012, "#333333", 0.4, 0.5, (p[0], p[1] + 0.006, p[2]), "gps")]
    if aid == "sdr":
        return [box(0.05, 0.014, 0.022, "#3355aa", 0.3, 0.5, (p[0], p[1] + 0.007, p[2]), "sdr")]
    if aid == "seconddisplay":
        return [box(0.10, 0.07, 0.008, "#111111", 0.4, 0.4, (p[0], p[1] + 0.045, p[2]), "bezel2"),
                box(0.09, 0.06, 0.002, "#0a2a1c", 0.0, 0.25, (p[0], p[1] + 0.045, p[2] + 0.005), "screen2")]
    if aid == "solar":
        return [box(0.16, 0.004, 0.11, "#0b2447", 0.6, 0.25, (p[0], p[1], p[2]), "solar")]
    if aid == "engrave":
        return [box(0.08, 0.002, 0.018, "#c98f2e", 0.9, 0.3, (p[0], p[1], p[2]), "plate")]
    return []

def assemble(cfg):
    fam = cfg["case"]; case = CASES[fam]; W, D = case["w"], case["d"]
    meshes = case_meshes(fam)
    hinge = (0, 0.02, -D / 2)
    if cfg["display"] != "none":
        meshes += display_meshes(cfg["display"], hinge)
    kb, kw, kd = keyboard_meshes(cfg["board"], cfg.get("keycaps", "chunky"), cfg.get("touchpad", "none"),
                                  pos=(0, 0.024, 0.015))
    meshes += kb
    # Accessories in deck space (back edge / right side, never over the keys)
    bx, bz = W / 2 - 0.03, -D / 2 + 0.03
    slots = {"esp32lcd": (bx - 0.05, 0.022, bz), "esp32second": (bx - 0.13, 0.022, bz),
             "lora": (-bx, 0.02, bz), "wifi": (-bx + 0.04, 0.02, bz),
             "gps": (bx, 0.022, D / 2 - 0.03), "sdr": (-bx, 0.022, D / 2 - 0.03),
             "seconddisplay": (bx, 0.022, 0.0), "solar": (0, 0.14, -D / 2 - 0.07),
             "engrave": (0, 0.022, D / 2 - 0.015)}
    for a in cfg.get("accessories", []):
        if a in slots:
            meshes += accessory_meshes(a, slots[a])
    return meshes

def save(meshes, relpath):
    path = os.path.join(ROOT, relpath)
    os.makedirs(os.path.dirname(path), exist_ok=True)
    scene = trimesh.Scene(meshes)
    scene.export(path)
    return {"file": "assets/models/" + relpath, "bytes": os.path.getsize(path),
            "meshes": len(meshes)}

manifest = []
for fam, c in CASES.items():
    manifest.append({"id": f"case-{fam}", "category": "case", "name": c["label"] + " case shell",
                     **save(case_meshes(fam, standalone=True), f"cases/case-{fam}.glb")})
for board in BOARDS:
    for tp in (["none"]):
        manifest.append({"id": f"keyboard-{board.lower()}", "category": "keyboard",
                         "name": f"{board} keyboard PCB + keys (no touchpad)",
                         **save(keyboard_meshes(board, "chunky", "none", pos=(0, 0, 0), standalone=True)[0],
                                f"keyboards/keyboard-{board.lower()}.glb")})
for size in DISPLAYS:
    manifest.append({"id": f"display-{size}in", "category": "display", "name": f"{size}″ display",
                     **save(display_meshes(size, standalone=True), f"displays/display-{size}in.glb")})
for tp, label in [("side", "Side touchpad bay"), ("center", "Center touchpad"),
                  ("trackball", "Trackball"), ("stick", "Pointing stick")]:
    # Touchpad-only file: a keyboard frame is not needed, export the pointer itself
    if tp in ("side", "center"):
        m = [box(0.055, 0.004, 0.04, "#1c2b22", 0.2, 0.4, (0, 0, 0), "touchpad")]
    elif tp == "trackball":
        m = [sphere(0.017, "#5eead4", 0.3, 0.3, (0, 0, 0), "trackball")]
    else:
        m = [cyl(0.004, 0.012, "#222222", 0.2, 0.6, (0, 0, 0), "stick")]
    manifest.append({"id": f"touchpad-{tp}", "category": "touchpad", "name": label,
                     **save(m, f"touchpads/touchpad-{tp}.glb")})
for aid, label in [("esp32lcd", "ESP32 + LCD status module"), ("esp32second", "Second ESP32 coprocessor"),
                   ("lora", "LoRa antenna"), ("wifi", "High-gain Wi-Fi antenna"),
                   ("gps", "GPS module + antenna"), ("sdr", "SDR receiver"),
                   ("seconddisplay", "Second small display"), ("solar", "Solar input panel"),
                   ("engrave", "Engraving plate")]:
    manifest.append({"id": f"accessory-{aid}", "category": "accessory", "name": label,
                     **save(accessory_meshes(aid), f"accessories/accessory-{aid}.glb")})

BUILDS = {
    "vintage-writer": dict(compute="pi5", display="10", battery="standard", case="vintage",
                           form="typewriter", board="SB-Type", touchpad="none", keycaps="vintage",
                           accessories=["esp32lcd", "lora"]),
    "field-operator": dict(compute="orin", display="10", battery="hotswap", case="tactical",
                           form="luggable", board="SB-65", touchpad="trackball", keycaps="chunky",
                           accessories=["esp32lcd", "esp32second", "wifi", "gps"]),
    "stealth-book": dict(compute="pi5", display="7", battery="standard", case="hidden",
                         form="book", board="SB-40", touchpad="none", keycaps="low",
                         accessories=["esp32lcd"]),
}
for slug, cfg in BUILDS.items():
    manifest.append({"id": f"build-{slug}", "category": "build", "name": slug.replace("-", " ").title() + " — complete deck",
                     **save(assemble(cfg), f"builds/build-{slug}.glb")})

with open(os.path.join(ROOT, "manifest.json"), "w") as f:
    json.dump({"units": "metres, Y-up", "count": len(manifest), "models": manifest}, f, indent=2)
print(f"Wrote {len(manifest)} GLB files + manifest.json")
for m in manifest:
    print(f"  {m['file']}  ({m['bytes']} bytes, {m['meshes']} meshes)")
