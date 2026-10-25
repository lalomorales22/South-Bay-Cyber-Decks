# Ordering, Pricing & Build Process

## Prices are estimates, quotes are final

The configurator gives a starting estimate so you can compare builds.
Final price depends on: display choice, battery size, case machining,
keyboard routing complexity, and accessory availability.

**We never cut, order a custom PCB, or charge a build deposit until you
approve a final build sheet with the exact price.**

Starting estimates in the configurator (Oct 2026) are built as:

- Base build labor + wiring + test: $450
- Computer: Pi 5 $0 / Orin Nano +$250 / BYO −$80
- Display: 7″ +$90 / 10″ +$140 / 13″ +$210
- Case family: $220–$340 + form $0–$80
- Keyboard platform: $140–$210 + touchpad $0–$65
- Accessories: as listed in the configurator

## How to order (v1, no checkout yet)

1. Build your deck at `index.html`, copy the Build Code / JSON.
2. Send it to South Bay IT Solutions with your name and shipping city.
3. We reply with a final quote + build sheet (case dimensions, keyboard
   layout diagram, power/thermal notes, delivery estimate).
4. You approve. We build. You get progress photos.
5. Burn-in + test, then ship with the build sheet and keyboard map.

Future: an order form and deposit checkout will replace step 2. The
Build JSON in `configurator/` is already the order payload that form
will submit.

## Build sheet

Every deck ships with a one-page build sheet: computer, display,
battery, case dimensions, keyboard board + keymap, accessory list, and
firmware version. Keep it — it's how you (or we) repair and mod the
deck later. Template: `docs/build-sheet-template.md`.

## Warranty / support (to confirm before first sale)

- Workmanship: builder defects repaired free for 12 months (target).
- Parts: covered by manufacturer warranty where applicable.
- Mods you make after delivery are yours — we keep the build sheet so
  we can still help.
- Batteries: follow the care notes on your build sheet; swelling =
  stop using it and contact us.

These terms are draft until the first public price list ships. Don't
publish a warranty promise to customers until it's confirmed in this
file.
