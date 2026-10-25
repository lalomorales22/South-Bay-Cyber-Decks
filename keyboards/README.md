# Custom Keyboard PCB Platform

The keyboard is not an accessory here. It's the product inside the product.

Everyone else reuses the same mini keyboard. We build the keyboard around
the deck — and around your hands.

## The idea in one paragraph

**10 base boards, cut to fit.** Each board below is a starting platform
with a documented outline, key grid, and cut zones. We trim the outline
to your case, place keys on the grid where you want them, and add a
touchpad bay only if you want one. Keycaps, switches, and firmware are
chosen per build. Fine per-key placement lives in the separate PCB
designer app — this document is the platform spec that app designs
against.

## The 10 base boards

| ID | Name | Keys | Layout | Outline (max) | Touchpad bays | Best for |
| --- | --- | --- | --- | --- | --- | --- |
| SB-40 | Pocket | ~40 | Ortholinear 4×10 | 220 × 80 mm | Side only | Ultra-compact, hidden decks |
| SB-50 | Compact | ~50 | Ortholinear 5×10 | 240 × 95 mm | Side | Small clamshells |
| SB-60 | Classic | 61 | Staggered | 295 × 105 mm | Side, center | The default — most decks |
| SB-65 | 65 | 68 | Staggered + arrows | 315 × 105 mm | Side, center | Everyday decks |
| SB-75 | 75 | 82 | Staggered + F-row | 320 × 120 mm | Side, center | Luggables, desk decks |
| SB-Ortho48 | Ortho 48 | 48 | Ortholinear 4×12 | 280 × 95 mm | Side | Ortho fans, coders |
| SB-Split36 | Split 36 | 36 | Split ergo 3×6×2 | 2 × 130 × 95 mm | None / stick | Ergo, split-form decks |
| SB-Type | Typewriter | 60 | Vintage staggered | 300 × 115 mm | None | Vintage Terminal, wedge builds |
| SB-Track | Track | 61 + pad | Staggered + pad bay | 320 × 110 mm | Built-in center/side | No-mouse builds |
| SB-Macro | Macro | 61 + macros | Staggered + macro col + knobs | 315 × 110 mm | Side | Radio, SDR, streaming decks |

All boards: RP2040 (or STM32 on request), USB-C, QMK / ZMK, hotswap
sockets, per-key RGB optional, 1.6 mm FR4, black / white / custom solder
mask on request.

## With and without a touchpad — the rule

Every board except Split and Typewriter supports:

- **None** — cleanest, lightest, cheapest. Pair with a mouse or trackball.
- **Side touchpad bay** — pad to the right of the keys, like a laptop
  numpad zone. Keeps the typing area untouched.
- **Center touchpad** — below the spacebar, laptop-style. Needs SB-60 or
  larger (or SB-Track, which is built for it).
- **Trackball** — 34 mm ball, right side, for field decks with gloves.
- **Pointing stick** — nub between G/H/B, for Split and compact decks.

The touchpad is a *bay* in the PCB outline, not a stuck-on module — so
the board shape actually accounts for it, and the case cutout matches.

## Shaping the board + placing keys

This is the part the stock keyboards can't do:

1. **Cut zones** — each platform drawing marks keep-out zones (MCU,
   USB-C, pad bay) vs. free trim zones (edges, corners, thumb clusters).
   We cut the outline inside the free zones to fit your case.
2. **Key grid** — keys snap to a 19.05 mm (1u) grid, ortho or staggered.
   Move a cluster, drop a key, add a thumb row — as long as it stays on
   grid and out of keep-outs, we can route it.
3. **Designer handoff** — the PCB designer app exports a keymap +
   outline (see `../configurator/build-config.schema.json`, field
   `keyboard.designer_export`). That export becomes the fabrication
   file for your board. Until that app ships, we take key placement as
   a marked-up grid diagram on your build sheet.

## Keycaps

- **Low-profile, backlit** — sleek decks, travel
- **Chunky tactile** — field decks, gloves, long sessions
- **Vintage round typewriter caps** — Vintage Terminal + SB-Type only,
  the look that sells the whole deck
- **Blank / custom legends** — your labels, your language, your macros

Switches: linear, tactile, or clicky; quiet options for office/library
decks. Tell us in the build notes.

## What we need from you for a custom keyboard

1. Base board (SB-xx) from the table above
2. Touchpad: none / side / center / trackball / stick
3. Keycaps + switch feel
4. Any keys you want moved, added, or dropped — a sketch is fine, the
   designer app export is better

That's it. We confirm the routed layout on your build sheet before
fabrication.
