# CLAUDE.md

This file defines GLOBAL, NON-NEGOTIABLE rules for Claude Code.
These rules override all assumptions.

---

# RULE ZERO — READ ALL RULES FIRST (ABSOLUTE)

Before doing ANYTHING:

1. Read this entire CLAUDE.md file from top to bottom.
2. Internalize ALL rules — not just the ones that seem relevant.
3. Every rule applies to every task, always.

STRICTLY FORBIDDEN:
- Do NOT start writing code before reading all rules.
- Do NOT skip sections that seem unrelated to the current task.
- Do NOT assume a rule doesn't apply without reading it first.
- Do NOT partially follow rules — all rules are binary: followed or violated.

If you violate any rule — even unintentionally — stop, acknowledge the violation, and fix it before continuing.

---

# SAFE FILE MODIFICATION RULES (CRITICAL)

You MUST:

1. Show changes as DIFF-style modifications.
2. Clearly separate:
- REMOVED CODE
- ADDED CODE
- MODIFIED CODE
3. Preserve all unrelated existing code.
4. Only touch the minimal necessary parts.
5. Keep original formatting and structure.

---

# FIGMA PIXEL-PERFECT & 1:1 IMPLEMENTATION RULE (ABSOLUTE)

All layouts MUST be implemented strictly 1:1 according to the provided Figma design.

This is not approximate.
This is not “visually similar”.
This is exact reproduction.

Pixel deviation tolerance: 0px unless explicitly approved.

MANDATORY REQUIREMENTS:

- Exact spacing (margin, padding, gaps)
- Exact typography (font-size, font-weight, line-height, letter-spacing)
- Exact colors (no approximations)
- Exact border-radius values
- Exact shadows (blur, spread, opacity)
- Exact strokes and borders
- Exact layout proportions
- Exact grid behavior
- Exact breakpoints as shown in Figma
- Exact responsive behavior per breakpoint
- Exact hover / focus / active states
- Exact animation timing and easing (if present in Figma)

STRICTLY FORBIDDEN:

- Do NOT approximate values
- Do NOT round numbers unless Figma rounds them
- Do NOT visually balance spacing
- Do NOT simplify layout
- Do NOT reinterpret the design
- Do NOT improve typography
- Do NOT normalize inconsistent spacing
- Do NOT change design decisions
- Do NOT merge or restructure layout for convenience

Design accuracy overrides developer convenience.
No creative interpretation allowed.
Implementation must match Figma 1:1.

---

# ACCESSIBILITY (MANDATORY)

For EVERY interactive element:

- Full keyboard navigation
- Visible focus styles
- Semantic elements only
- No div buttons
- Proper focus management
- aria-* only when meaningful

Never sacrifice accessibility for visual accuracy.

---

# STYLES (CSS) — SOURCE ONLY

- Author styles in standard CSS files.
- Do NOT generate compiled build artifacts.

Rules:
- Follow existing nesting depth and naming conventions.
- Do NOT introduce new build tools.

---

# SCRIPTS (JS) — SOURCE ONLY

- Author scripts in readable (non-minified) JS.
- Always verify which file is enqueued (`.js` or `.min.js`) before editing.
- Edit ONLY the source file requested by the user.
- Do NOT generate `.min.js` files.
- Do NOT output any compiled/minified builds.

Rules:
- Do NOT change the theme’s existing JS init patterns.
- Do NOT introduce bundlers.
- Preserve existing enqueue conventions.

## Modern JS Syntax (MANDATORY)

Always write JS using modern ES6+ syntax.

Prefer:
- `const` / `let` — never `var`
- Arrow functions `() => {}` — instead of `function() {}`
- Spread operator `[...arr]` — instead of `Array.prototype.slice.call(arr)`
- Default parameters `fn(x = 2)` — instead of `x = x || 2`
- Method shorthand `{ onDrag() {} }` — instead of `{ onDrag: function() {} }`
- `window.innerWidth` — instead of `$(window).width()` (avoid jQuery for simple checks)
- Template literals `` `${val}` `` — instead of string concatenation

STRICTLY FORBIDDEN:
- Do NOT use `var`
- Do NOT use `Array.prototype.slice.call()`
- Do NOT use `Array.prototype.forEach.call()`
- Do NOT use legacy function expressions where arrow functions are cleaner

Important:
- Do NOT refactor the entire file just to modernize it.
- Apply modern syntax ONLY to newly written code or lines being modified.
- Files explicitly requested for refactor → modernize fully.

---

## Minified JS files (STRICT)

- NEVER manually edit `.min.js` files.
- NEVER generate or output `.min.js` content.
- Always edit only the `.js` source file.

---

# PHP TEMPLATE & VERSION RULES (MANDATORY)

## 1) Modern PHP version

- Always write code compatible with the latest stable PHP version.
- Use modern PHP syntax and features where appropriate.
- Prefer:
    - null coalescing operator `??`
    - null coalescing assignment `??=`
    - typed parameters and return types
    - strict comparisons `===`
    - arrow functions `fn() =>`
    - match expressions (when suitable)
    - constructor property promotion (if applicable)

- Do NOT write legacy-compatible PHP (5.x style).
- Do NOT downgrade syntax for backward compatibility.
- Assume modern PHP environment.

---

## 2) error_log — DO NOT REMOVE (STRICT)

- NEVER remove, delete, or strip `error_log(...)` calls from any PHP file.
- This applies to ALL `error_log` lines regardless of state:
    - Active (uncommented)
    - Commented out (`// error_log(...)`)
- Do NOT remove them even during refactoring, renaming, or restructuring.
- Do NOT remove them "for cleanliness" or "for production readiness".
- They must remain exactly as found in the original file.

Exception:
- Only remove or modify `error_log` lines if the user **explicitly requests it**.

---

## 3) Echo syntax (STRICT)

- Always use short echo tags:

  CORRECT: `<?= esc_html($title) ?>`
  WRONG:   `<?php echo esc_html($title); ?>`

- Never use `print`.

---

## 4) Control structures (STRICT)

- Do NOT use alternative syntax:

  WRONG: `if (): endif;`
  WRONG: `foreach (): endforeach;`
  WRONG: `while (): endwhile;`

- Always use curly braces `{}`:

  CORRECT: `<?php if ($cond) { ?>`
  CORRECT: `<?php foreach ($items as $item) { ?>`

Do not follow existing legacy patterns if they violate these rules.

---

# SECTION STRUCTURE PATTERN (MANDATORY)

All new page templates and new sections MUST follow the container pattern established in `page-home.php`.
This applies to every page template (`page-*.php`, `page-home.php`, `single-*.php`, `archive-*.php`) and every new section added to an existing page.

## Required HTML structure

Every top-level section MUST use this three-level container pattern:

```php
<section class="section section--{name}" aria-labelledby="{name}-title">
    <div class="section__inner">
        <!-- section content goes here -->
        <div class="section__content {name}__content">
            ...
        </div>
    </div>
</section>
```

Responsibilities per level:

- `.section` — outer wrapper. Owns: horizontal edge padding (default `20px`), vertical padding, full-width backgrounds, absolute-positioned pseudo-elements (gradients, bg images), `position: relative`, `overflow: hidden` when needed.
- `.section--{name}` — modifier class for section-specific overrides (padding, background, positioning, `::before` decorations).
- `.section__inner` — content container. Owns: `width: 100%`, `max-width`, `margin: 0 auto`. Default max-width is `var(--container-max)` (1500px). Override per section when Figma specifies a narrower width.
- `.section__content` — OPTIONAL inner layout block. Use only when the section has an internal flex/grid content area (multi-column, card rows). Skip when `.section__inner` holds simple stacked blocks.
- `.{name}__*` — BEM sub-elements for section-specific pieces (`.intro__heading`, `.features__image`, `.journal-item__info`, etc.).

## Per-section max-width overrides

Override on `.section--{name} .section__inner { max-width: ... }` — NEVER on child content blocks.

Established widths in the current codebase (match Figma):

| Section | max-width |
|---------|-----------|
| `section--case-study` | 980px |
| `section--blog` | 620px |
| All other sections | 1500px (default via `--container-max`) |

If a section has two inner blocks with different widths (like `section--intro` with text `max-width: 1030px` and image `width: 960px`), keep `.section__inner` at the default max-width and apply the specific widths on the individual child blocks (`.intro__content`, `.intro__image`).

## Base CSS (already defined in `style.css`)

```css
.section {
    position: relative;
    padding: 0 20px;
}

.section__inner {
    width: 100%;
    max-width: var(--container-max);
    margin: 0 auto;
}
```

Do NOT redefine these base rules. Only add section-specific modifiers (`.section--{name}` and `.section--{name} .section__inner`).

## Rules

1. NEVER place content directly inside `<section>` without wrapping it in `.section__inner`. The inner container is mandatory — even for single-element sections.
2. NEVER set `max-width` on arbitrary content blocks to cap section width — always go through `.section__inner`.
3. NEVER set horizontal page padding on inner blocks — it belongs on `.section` (or its `.section--{name}` override).
4. Full-width backgrounds belong on `.section--{name}` (so they extend edge-to-edge), never on `.section__inner`.
5. If a section needs a decorative gradient, background image, or overlay, use `::before`/`::after` on `.section--{name}` OR an absolutely-positioned child inside `.section` (as `section--values` does with `.values__bg`).
6. Always pair section modifier with base class: `class="section section--{name}"`. Never use `section--{name}` alone.
7. Section BEM names use kebab-case: `section--case-study`, `section--cta`, `section--features`.

## Responsive overrides

Section padding and inner gap overrides for tablet / mobile live inside the existing `@media` blocks in `style.css`. Target them via the modifier:

```css
@media (max-width: 1024px) {
    .section--features { padding: 80px 20px; }
    .section--features .section__inner { gap: 40px; }
}
```

Never introduce new `@media` blocks — use the existing Tablet (≤1024px) and Mobile (≤768px) blocks.

## STRICTLY FORBIDDEN

- Do NOT use a flat section structure (`<section class="foo"> ... </section>` with no `.section__inner` wrapper).
- Do NOT introduce new generic container classes (`.container`, `.wrapper`, `.row`, `.inner`). Reuse `.section__inner`.
- Do NOT inline `max-width` on random children to cap content width — always on `.section__inner`.
- Do NOT merge responsibilities: outer padding belongs on `.section`, max-width on `.section__inner`, internal layout on `.section__content` or section-specific sub-elements.
- Do NOT create a new max-width value without confirming it against Figma.

## Reference implementation

`page-home.php` + `style.css` contain the canonical implementation across 7 sections: `intro`, `features`, `values`, `case-study`, `blog`, `testimonial`, `cta`. When in doubt, copy the pattern from there exactly.

---

# MENTAL MODEL

You are extending a production codebase.
Not building a new theme.
Not refactoring.
Not redesigning.

Precision > creativity.
Consistency > innovation.
System integrity > speed.

If anything is unclear:
→ ASK BEFORE PROCEEDING.

---

# RESPONSIVE RULES (MANDATORY)

## 1) clamp usage

- Use `clamp()` ONLY for pixel-based values.
- See section 1.1 for strict limitations.
- For mobile (max-width: 1024px), use `clamp(..., 200, 393)` unless explicitly told otherwise.

---

## 1.1 clamp — STRICT USAGE RULES

`clamp()` may ONLY be used when the value is defined in pixels (px) in Figma.

DO NOT use `clamp()` for:

- border-radius
- percentage values (%)
- flex-basis in %
- width/height in %
- opacity
- z-index
- font-weight
- line-height when defined unitless
- transform values
- box-shadow values
- gradient stops
- any non-pixel-based unit

Border-radius rule:

- Border-radius values must always match Figma exactly.
- If Figma says `24px`, write `24px`.
- Never convert border-radius to clamp().
- If border-radius changes between breakpoints in Figma,
  set exact px values per breakpoint inside existing media blocks.
- Never scale border-radius responsively unless explicitly required by Figma.

Percentage rule:

- If Figma uses percentages (e.g., 36.18% width),
  use the percentage directly.
- Never wrap percentage values in clamp().

Golden rule:

clamp() is allowed ONLY for pixel-based spacing and typography:

- font-size
- line-height (if px-based)
- margin
- padding
- gap
- width
- height (when defined in px)

If unsure whether clamp should be used:
→ STOP and ask before applying it.

---

## 2) Do NOT duplicate media queries

- Always use the existing `@media` blocks already present in the file.
- Never create new duplicated `@media` blocks.
- If the needed breakpoint does not exist → STOP and ask before adding a new media query.

---

## 3) Nesting & removability

- All styles for a new feature/block MUST live under one nested branch:
  `.section-or-wrapper` → `.new-block` → children…
- Keep all related overrides grouped and easy to remove:
    - Add clear `// START <block-name>` and `// END <block-name>` comments inside each existing media block.

---

## 4) Breakpoint source of truth

- Never invent breakpoint values.
- If Figma provides separate frames (2560 / 1920 / 1536 / 393),
  implement them using the existing breakpoint system and `clamp()`,
  not by adding new arbitrary breakpoints.
- If Figma requires a breakpoint that does not exist in the system → STOP and ask.

---

# ASSETS: ICONS MUST BE SVG (MANDATORY)

- Any small UI icon (checkmarks, arrows, close icons, small badges, UI glyphs) MUST be `.svg`.
- Do NOT use `.png` for icons unless explicitly required by the design.
- If downloaded as PNG by mistake → re-export as SVG.
- Code must reference the correct extension.

---

# RASTER IMAGES (PNG / JPG) — 2X RULE (MANDATORY)

## 1) Desktop raster images

- Any raster image (PNG / JPG) must be exported in 2x resolution.
- Example:
    - 640px design → export 1280px.
    - 504px design → export 1008px.
- Never use 1x for desktop.

## 2) Mobile-specific images

- If mobile design differs → export separate image.
- Mobile exports must ALSO be 2x.
    - 344px design → export 688px.

## 3) Do NOT upscale artificially

- Do not fake 2x via CSS scaling.
- The exported asset itself must be 2x.

## 4) SVG exception

- SVG does NOT follow 2x rule.
- Small UI icons must always be SVG.

## 5) Verification before download

Before downloading from Figma:

- Confirm node width.
- Calculate required 2x width.
- Export exactly that size.
- Print exported image resolution.

---

# LANGUAGE RULE (MANDATORY)

All explanations and confirmations must be written in Ukrainian.

Exceptions:
- PHP comments must remain in English.
- Code must remain in English.
- Variable names must remain in English.

Never switch to English in explanations unless explicitly requested.

## CLAUDE.md language rule (MANDATORY)

- ALL content written inside CLAUDE.md must be in English only.
- Never write Ukrainian or Russian inside CLAUDE.md.
- This applies to rules, descriptions, comments, and examples.

---

# MCP SERVERS

## Figma MCP — default server (MANDATORY)

- ALWAYS use the `figma` MCP server for all Figma-related tool calls.

This applies to ALL Figma tools:
- `get_design_context` → use `mcp__figma__get_design_context`
- `get_screenshot` → use `mcp__figma__get_screenshot`
- `get_metadata` → use `mcp__figma__get_metadata`
- `get_variable_defs` → use `mcp__figma__get_variable_defs`
- `generate_diagram` → use `mcp__figma__generate_diagram`
- and all other Figma tools → use `figma` prefix

---

# CUSTOM COMMANDS

## How to invoke a command (MANDATORY)

Commands are ONLY executed when the user explicitly triggers them.

Accepted trigger formats:
- `/command` — e.g. `/ship`
- `run /command` — e.g. `run /ship`
- `виконай /command` — e.g. `виконай /ship`

NEVER execute a command automatically, proactively, or as a side effect of another task.
NEVER suggest running a command unless the user asks.

---

## Available commands

| Command | Purpose | Who uses it |
|---------|---------|-------------|
| `/ship` | Commit and push all changes to current branch | Dev |
| `/ship-qa` | Merge current branch into QA and push | Dev |
| `/summary` | Generate task summary for manager (Russian) | Dev |

---

## Git commands — EXPLICIT REQUEST ONLY (ABSOLUTE)

- NEVER execute `/ship`, `/ship-qa`, or ANY Git operation (`git add`, `git commit`, `git push`, etc.) unless the user explicitly types the command or requests it.
- Do NOT proactively run Git commands after completing a task.
- Do NOT assume the user wants to commit/push just because a task is finished.
- Wait for the user to type `/ship` or `/ship-qa` explicitly.

---

## /ship

When the user types `/ship`, execute the following Git workflow in order:

1. `git add .`
2. `git status`
    - Read the output to understand exactly which files were changed.
3. `git commit -m "..."`
    - Generate a concise commit message in English only based on `git status` output.
    - Maximum 10–15 words.
    - Must accurately reflect the actual changes made in this session.
    - Use imperative mood (e.g. "add", "fix", "update", "remove").
    - No ticket numbers, no Co-Authored-By, no extra metadata.
4. `git push`

Rules:
- Never skip any of the four steps.
- Never ask for confirmation — execute immediately without any prompts.
- Never let the user write the commit message — always auto-generate it based on `git status`.
- If `git push` fails, report the error and stop.
- After successful push — just notify the user with a short summary. No confirmation dialogs at any step.

---

## /ship-qa

When the user types `/ship-qa`, execute the following Git workflow in order:

1. Save the current branch name: `git branch --show-current`
2. `git checkout QA-10-11-25`
3. `git pull origin QA-10-11-25`
4. `git merge <current-branch>` — merge the saved branch into QA-10-11-25
5. `git push origin QA-10-11-25`
6. `git checkout <current-branch>` — return to the original branch

Rules:
- Never skip any of the six steps.
- Never ask for confirmation — execute immediately.
- If merge has conflicts — stop, report the conflicts, do NOT push.
- If `git push` fails, report the error and stop.
- Always return to the original branch at the end, even if an error occurs.

---

## /summary

When the user types `/summary`, generate a task summary for a non-technical manager in **Russian language** using the following format:

> LANGUAGE WARNING — ABSOLUTE, NO EXCEPTIONS:
> The ENTIRE output of `/summary` MUST be written in **Russian (русский язык)**.
> NEVER write in Ukrainian. NEVER write in English.
> This rule overrides the global language rule (which says Ukrainian for explanations).
> If you write even one sentence in Ukrainian — it is a violation.

```
## [Task name]

[1-2 sentences — how it worked before]

[1-2 sentences — what changed and what business/user benefit it brings]

**How to use:** (if there is something to explain to the admin)
- ...

[link admin] (if there is a link to the admin panel)
[screen] (if there is a screenshot)
```

Context gathering:
- First, try to use the current conversation history to understand what was done.
- If conversation history is missing, unclear, or insufficient — run `git status` and `git diff` to identify all uncommitted changes, then base the summary on those changes.
- Combine both sources if available — conversation history for intent, git diff for accuracy.

Rules:
- Minimum technical details — only if it helps understand what exactly changed
- No function names, PHP code, table names, or hooks
- Explanation must be understandable to a manager without technical knowledge
- ALWAYS in Russian language — NEVER Ukrainian, NEVER English
- If there is an admin field — explain how to use it
- If the task affects user behavior (student, buyer) — mention it separately
- If there is a default value or fallback — mention it so the manager understands what happens if the field is left empty
- Leave `[link admin]` and `[screen]` placeholders if the user said they will add them manually
- Tone — professional but simple, no filler words