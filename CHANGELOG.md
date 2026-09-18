# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Fixed

- The release archive was missing `.mo` files entirely (no Russian translation at all): `compress-app-plugin.php` merges `.gitignore` rules into its own exclude list, so `locale/**/*.mo` there was also cutting the freshly-compiled `.mo` out of the packaged archive, not just out of git. Removed the gitignore entry — `.mo` files still aren't committed, but the CI-compiled copy now makes it into the archive.

## [2.0.1] - 2026-09-18

### Changed

- Noted in the `product_date`/`edit_history` settings' descriptions that both only affect the legacy UI 1.3 product editor, not UI 2.0 — matching what the Store description already said.

### Removed

- The "add to cart URL" setting and the `plugin_tips/to_cart/` route/controller built for Yandex's Turbo cart integration, which Yandex has discontinued. Shops that had the setting enabled will stop resolving that URL (it now 404s instead of adding to cart) — there is no live consumer of it left to break. An update script (`lib/updates/2.0.0/1789736781.php`) clears the leftover `add2cart` setting value from the database.

## [2.0.0] - 2026-09-18

### Added

- `tips_plugin_footer_js` hook and `shopTipsPluginViewHelper::footer_js()` helper that let other plugins hand off JS/CSS to be injected just before the closing `</body>` tag, so a design theme can load them in one ordered place instead of each plugin writing directly into templates (requires Shop-Script 8.18+).
- `shopTipsPluginViewHelper::getCouponById()` exposes the existing coupon-lookup helper through the plugin view helper API.
- `LICENSE.md` (MIT) and `.editorconfig`.

### Changed

- Raised minimum requirements: PHP >= 7.4, `app.shop` >= 8.18 (previously only `app.installer` >= 2.0.0 was required).
- Internal cleanup of `shopTipsPlugin`, `shopTipsPluginProductLog`, and the Yandex.Turbo cart-add action.
- Plugin name in `lib/config/plugin.php` is no longer wrapped in a live `_wp()` call (needed so the release packaging tool can safely parse the config as static data); the name is now only translated via the `.po` catalog at compile/extraction time, not re-resolved at runtime. Practical effect: the plugin name in the backend plugin list stops following the admin's locale and always reads "Useful Stuff".

### Fixed

- `shopTipsLogModel::actionType()` misclassified log entries whose action name started with `del`/`add` (e.g. a hypothetical `delete_*` action): `strpos()` returning `0` was treated as falsy, so the check silently fell through to the wrong branch. Now compares against `false` explicitly.

## [1.5.0] - 2018-09-21

### Added

- Cart-add URL generation for Yandex.Turbo product offers.

## [1.4.3] - 2018-04-18

### Fixed

- Product edit-history tab on the product card.

## [1.4.2] - 2018-04-13

### Fixed

- Issues introduced by the previous update.

## [1.4.1] - 2018-04-08

### Changed

- Ensured compatibility with upcoming Shop-Script updates.

## [1.4.0] - 2017-04-10

### Added

- Display of the product edit history on the product card in the backend.

## [1.3.0] - 2017-03-22

### Added

- Option to disable the product creation/modification dates, or choose their display format (date only, or date with time).

## [1.2.0] - 2016-10-06

### Added

- Estimated delivery date display when viewing an order in the backend.

## [1.1.0] - 2016-06-11

### Added

- Helper to look up coupon information by coupon ID.

## [1.0.0] - 2015-10-28

Initial release.

[Unreleased]: https://github.com/Syrnik/shop-tips/compare/v2.0.1...HEAD
[2.0.1]: https://github.com/Syrnik/shop-tips/compare/v2.0.0...v2.0.1
[2.0.0]: https://github.com/Syrnik/shop-tips/compare/v1.5.0...v2.0.0
[1.5.0]: https://github.com/Syrnik/shop-tips/compare/v1.4.3...v1.5.0
[1.4.3]: https://github.com/Syrnik/shop-tips/compare/v1.4.1...v1.4.3
[1.4.1]: https://github.com/Syrnik/shop-tips/compare/v1.4.0...v1.4.1
[1.4.0]: https://github.com/Syrnik/shop-tips/compare/v1.3.0...v1.4.0
[1.3.0]: https://github.com/Syrnik/shop-tips/compare/v1.2.0...v1.3.0
[1.2.0]: https://github.com/Syrnik/shop-tips/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/Syrnik/shop-tips/releases/tag/v1.1.0
