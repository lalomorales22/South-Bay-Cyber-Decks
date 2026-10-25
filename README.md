# South Bay Cyber Decks

Custom-built cyberdecks, made to order in South Bay.

**You design it. We bring it to life.**

Most cyberdecks on the market force you into one mini keyboard and one
box. We do the opposite: pick your computer, pick your case, shape your
keyboard, add the accessories you actually want — and we build that exact
deck, by hand, around you.

🌐 **Live site / configurator:** open `index.html` in this repo, or enable
GitHub Pages on `main` (root) and share the Pages URL.

🚀 **Production landing page:** `landing/index.php` — a single-file,
no-dependency landing page + configurator v2 (case gallery with filters,
Pi vs Orin comparison, live deck + keyboard schematic previews, price
breakdown, example builds, FAQ, and a PHP lead form that re-prices
server-side). Run it from the repo root with PHP:
`php -S localhost:8000` then open http://localhost:8000/landing/index.php
(serve from the root, not `-t landing`, so `../assets/models/` resolves).
Note: GitHub Pages does not execute PHP, so the lead form's server
validation needs a PHP host — the JS configurator in `index.html`
remains the Pages version.

🎲 **3D assets:** `assets/models/` — 35 real GLB files: 6 cases, 10
keyboards, 3 displays, 4 touchpads, 9 accessories, 3 complete example
builds, plus `manifest.json`. Regenerate with
`python3 tools/build-3d-assets.py`. The builder's 3D deck is live
Three.js (orbit, auto-rotate, exploded view, top view) and rebuilds as
you change case, keyboard, display, and accessories — with PBR materials,
soft shadows, a live terminal screen texture, and canvas textures for
the ESP32 LCD and solar panel. See `assets/models/README.md`.

> Prices on this site are **starting estimates** for planning, not final
> quotes. Final price depends on display, battery, machining, and keyboard
> options. Every build gets a confirmed quote before we cut anything.

---

## Build it in 5 steps

1. **Computer** — Raspberry Pi or NVIDIA Jetson Orin Nano
2. **Case** — Vintage, Sleek, Tactical, Hidden, Exposed, or Luggable
3. **Form** — Foldable clamshell, slab, typewriter wedge, luggable, split, or book
4. **Keyboard** — One of 10 cut-to-fit PCB platforms, with or without a
   touchpad, keys placed to fit *your* case — not the other way around
5. **Accessories** — Extra ESP32s with LCDs, antennas, SDR, GPS, extra
   battery, and more

Use the configurator on the site. It gives you a live estimate and a
**Build Code** — a short summary + JSON you can send us to start the build.

## The keyboard is the whole point

Cyberdecks live or die on their keyboard, and right now there's basically
one mini keyboard everyone reuses. That's the gap we're filling.

- **10 base PCB platforms** — see [`keyboards/`](./keyboards/)
- **Cut to fit** — each board has documented cut zones, so we trim the
  outline to your case instead of forcing your case around a stock board
- **Keys where you want them** — ortholinear, staggered, split, or
  typewriter layouts, placed on the board grid for your deck
- **With or without a touchpad** — no touchpad, side touchpad bay,
  center touchpad, or trackball / pointing stick
- **Custom keycaps** — vintage round typewriter caps, low-profile,
  chunky tactile, backlit, or blank
- **Firmware** — QMK / ZMK, RP2040 or STM32, hotswap sockets, USB-C

The configurator covers the keyboard at a high level (board + touchpad +
caps). Fine-grained key placement, board shaping, and per-key mapping live
in the separate PCB designer app (in development) — this repo defines the
exchange format for it in [`configurator/`](./configurator/) so the two
can plug together later.

## Case families

See [`cases/`](./cases/) for the full catalog with photos-to-come,
dimensions, and trade-offs.

| Family | Vibe | Best for |
| --- | --- | --- |
| Vintage Terminal | Old-school beige computer, chunky keys | Retro builds, typewriter style |
| Sleek | Thin aluminum, minimal | Everyday carry, desk + travel |
| Tactical / Field | Rugged, handles, sealed edges | Field work, ham radio, off-grid |
| Hidden / Stealth | Looks like a book, briefcase, toolbox | Discreet carry |
| Exposed / Cyberpunk | Open frame, visible boards, brass + acrylic | Showpiece, maker fairs |
| Luggable | Suitcase-style, big screen, big battery | Portable workstation |

Form factors are independent of family: foldable clamshell, slab +
detachable keyboard, typewriter wedge, luggable, split two-piece, or book.

## Computers

| Option | Why pick it |
| --- | --- |
| Raspberry Pi 5 (8 GB) | Best value, huge software support, great for radio, SDR, coding, and retro |
| Jetson Orin Nano Super (8 GB) | On-device AI, CUDA, vision — for AI workloads the Pi can't touch |
| Bring your own board | You ship it, we design around it |

## Accessories

- ESP32 + LCD status module (battery, network, system stats)
- Second ESP32 — dedicated radio / sensor / coprocessor deck
- Antennas: high-gain Wi-Fi, LoRa, GPS, dual-band
- SDR receiver, extra battery pack, solar input, carry handle, custom engraving
- Full list + pricing in the configurator and [`docs/accessories.md`](./docs/accessories.md)

## How ordering works

1. Build your deck in the configurator and copy your Build Code / JSON.
2. Send it to us (form / email — see [`docs/ordering.md`](./docs/ordering.md)).
3. We confirm the quote, display, battery, and keyboard layout — no cutting
   until you approve the final build sheet.
4. We build, test, burn in, and ship with a build sheet + keyboard map.

## Repo layout

```
index.html            Live site + configurator (GitHub Pages-ready, no build step)
keyboards/            The 10 PCB platforms, cut zones, touchpad options
cases/                Case families, form factors, dimensions
docs/                 Ordering, pricing notes, FAQ, build-sheet template
configurator/         Build JSON schema + example build (for the PCB app)
builds/               Example customer builds (JSON)
```

## Status

- [x] Site + configurator v1
- [x] 10 keyboard PCB platforms defined
- [x] 6 case families + 6 form factors defined
- [ ] Case photos / renders
- [ ] PCB designer app integration (separate app, in development)
- [ ] Order form / checkout
- [ ] First 3 example builds photographed

## South Bay IT Solutions

This is a South Bay IT Solutions project. Business site, support, and
warranty terms live in [`docs/`](./docs/).
