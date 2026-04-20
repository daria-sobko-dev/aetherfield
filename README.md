# Aetherfield WordPress Theme

Custom WordPress theme for the Aetherfield marketing site — sustainability insights software.
Based on the Figma design, implemented with ACF Blocks architecture.

---

## Project status

**Current stage:** Home page complete. Migrating to multi-page site with CPT for Journal, Case Studies, and additional marketing pages.

### ✅ Done
- Global theme scaffolding (header, footer, navigation, typography tokens)
- Home page converted to ACF Blocks architecture (7 blocks)
- Responsive: Desktop (≥1025px), Tablet (769–1024px), Mobile (≤768px)
- Per-block CSS split with conditional enqueue (assets load only when block is on page)
- Block-scoped assets (sticker, quote icons live inside their blocks)
- Mobile burger menu with full-screen overlay
- Gutenberg Block Editor replaces Classic Editor for Home template

### 🟡 In progress
- Footer content editability via ACF (still hardcoded)
- SVG uploads via Safe SVG plugin

### 📋 Planned
- CPT: `journal` (blog posts) — single + archive templates
- CPT: `case_study` — single + archive templates
- Cross-page reusable ACF Blocks (Testimonial, CTA on single pages)
- Additional pages: About, Careers, Services
- Template parts for CPT cards (`journal-card.php`, `case-card.php`)

---

## Architecture

### Block-based layout
Each page section is a self-contained ACF Block. The template (`page-home.php`) is a thin wrapper around `the_content()` — section order and composition is controlled in the Gutenberg editor.

Blocks live in `/blocks/{name}/`:
```
blocks/intro/
├── render.php                         ← PHP template
├── style.css                          ← block-scoped CSS (auto-enqueued when block is on page)
├── group_aetherfield_block_intro.json ← ACF field group
└── (optional: view.js, preview.png, icon.svg, block-specific SVGs)
```

Blocks are registered in `inc/blocks.php` via `acf_register_block_type()`.
Available on Home template only — filtered through `allowed_block_types_all`.

### File structure
```
aetherfield/
├── acf-json/                          ← ACF field group JSON auto-save
├── assets/
│   └── images/                        ← global UI assets (logo, footer image, nav icons)
├── blocks/                            ← 7 ACF Blocks (each self-contained)
│   ├── intro/
│   ├── features/
│   ├── values/
│   ├── case-study/
│   ├── blog/
│   ├── testimonial/
│   └── cta/
├── inc/
│   ├── blocks.php                     ← register all ACF Blocks + allowed block types
│   ├── template-functions.php
│   └── template-tags.php
├── js/
│   └── navigation.js                  ← global JS (mobile nav toggle)
├── languages/
├── header.php
├── footer.php
├── page-home.php                      ← Template Name: Home
├── page.php / single.php / archive.php
├── functions.php
├── style.css                          ← global CSS (reset, tokens, typography, layout, nav, footer)
└── CLAUDE.md                          ← project rules & constraints
```

### Styling
- **Global `style.css`:** reset, design tokens (CSS variables), typography classes (`h-display-1/2`, `h-section`, `h-card`, `p-lg`), layout primitives (`.section`, `.section__inner`), buttons, navigation, footer.
- **Per-block `blocks/{name}/style.css`:** section-specific layout and decoration. Auto-enqueued only on pages where the block is present.
- **BEM naming** throughout. Responsive via `@media (max-width: 1024px)` (tablet) and `@media (max-width: 768px)` (mobile).

### Content
All content (text, images, button links, repeater items) is managed through ACF Pro fields per block:
- Text / textarea fields for copy
- Image fields (return as array with `url` + `alt`)
- Link fields (return as array with `url` + `title` + `target`)
- Repeaters for list items (features, value cards, journal items)

---

## Requirements

- WordPress ≥ 6.0
- PHP ≥ 7.4
- **ACF Pro ≥ 5.8** (required for Blocks, Link field, Repeater)
- **Safe SVG plugin** (for SVG uploads via Media Library)

---

## Fonts

Google Fonts loaded via `functions.php`:
- **Source Serif Pro** — serif display + body
- **Radio Canada Big** — sans display
- **Geist Mono** — mono (buttons, captions)

---

## Setup

1. Clone into `wp-content/themes/aetherfield/`
2. Activate theme in WP admin
3. Install and activate **ACF Pro** and **Safe SVG** plugins
4. **Custom Fields → Field Groups → Sync** — sync the 7 "Block: ..." field groups from local JSON
5. **Pages → Add New** → Title "Home" → Page Attributes → Template: **Home** → Publish
6. In the Gutenberg editor, add blocks from the **Aetherfield** category:
   Intro → Features → Values → Case Study → Blog → Testimonial → Call to action
7. Fill ACF fields in each block (see `CLAUDE.md` for default content)
8. **Settings → Reading** → Homepage displays: A static page → Homepage: Home
9. Upload images via Media Library and assign them in the block fields

---

## Conventions

See [`CLAUDE.md`](./CLAUDE.md) for full project rules, including:
- Pixel-perfect Figma 1:1 implementation
- BEM + section container pattern
- Responsive breakpoints (no custom media queries beyond tablet/mobile)
- Asset 2x rule for raster images, SVG for icons
- PHP short echo tags, curly braces only (no alternative syntax)
- Modern ES6+ JS, no `var`
- Accessibility (keyboard nav, focus styles, semantic HTML)

---

## Figma source

Design file: https://www.figma.com/design/cm5AicB7DZeK4zuLOOud0G

---

## License

GPLv2 or later.
