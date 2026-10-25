# 3D Assets

Real GLB files for every piece and every example build — not screenshots.

## What is here

- `cases/` — 6 case shells: vintage, sleek, tactical, hidden, exposed, luggable
- `keyboards/` — 10 keyboard PCBs with keys: SB-40, SB-50, SB-60, SB-65,
  SB-75, SB-Ortho48, SB-Split36, SB-Type, SB-Track, SB-Macro
- `displays/` — 4″, 7″, 10″, 13″ displays (true 16:9 sizes)
- `touchpads/` — side, center, trackball, pointing stick
- `accessories/` — ESP32+LCD, second ESP32, LoRa antenna, Wi-Fi antenna,
  GPS, SDR, second display, solar panel, engraving plate
- `builds/` — 4 complete decks: vintage-writer, field-operator, stealth-book, pocket-four (4″ compact)
- `manifest.json` — machine-readable list of all 37 files (bytes, meshes)

Units: metres, Y-up. A deck base is ~0.32–0.36 m wide, keys are on a
19.05 mm pitch, matching the configurator.

## How to view them

- **On the site:** `landing/index.php` — the builder has a live,
  interactive 3D deck (drag to orbit, Exploded view), and the 3D section
  lets you inspect any single GLB in a model-viewer.
- **In a browser:** drag any `.glb` into https://gltf-viewer.donmccurdy.com/
  or open it with `<model-viewer>`.
- **In Blender:** File → Import → glTF 2.0, pick a `.glb`.
- **Locally:** serve the repo root (not just `landing/`) so relative
  `../assets/models/` paths resolve:
  `php -S localhost:8000` from the repo root, then open
  `http://localhost:8000/landing/index.php`.

## Regenerating

`python3 tools/build-3d-assets.py`

That rebuilds all 37 GLBs + `manifest.json` from one script, so the
assets, the manifest, and the live Three.js visualizer stay in sync on
dimensions. Edit the script, not the GLBs by hand.

## Honest limits

These are clean, dimension-accurate schematics with realistic PBR
materials, lighting, and shadows in the viewer — not fabrication CAD.
Key legends, exact screw positions, and internal wiring are not
modelled. Final fabrication still uses the PCB designer app export and
the confirmed build sheet.
