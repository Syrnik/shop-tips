# AGENTS.md

## Commit Messages

All commits must follow the [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/) specification.

Format: `<type>[optional scope]: <description>`

Common types: `feat`, `fix`, `chore`, `refactor`, `docs`, `test`, `ci`.

## Changelog

The `CHANGELOG.md` file must follow the [Keep a Changelog](https://keepachangelog.com/en/1.1.0/) format.

- Add entries under `[Unreleased]` during development.
- On release, rename `[Unreleased]` to the version number with the release date.
- Sections within a version: `Added`, `Changed`, `Deprecated`, `Removed`, `Fixed`, `Security`.

## Static Analysis

Psalm runs against PHP 7.4 and 8.5 targets:

```bash
psalm --config=psalm74.xml
psalm --config=psalm85.xml
```

Both configs run `tests/psalm-init.php` as bootstrap and use an error baseline (`psalm-baseline-74.xml` / `psalm-baseline-85.xml`) to suppress pre-existing noise (mostly Webasyst's dynamic hook dispatch, which Psalm can't see, plus imprecise docblocks in the framework itself). New code must not add errors outside the baseline.

Regenerate a baseline only when accepting new pre-existing noise on purpose, never to hide a real bug you don't want to fix:

```bash
psalm --config=psalm74.xml --set-baseline=psalm-baseline-74.xml
psalm --config=psalm85.xml --set-baseline=psalm-baseline-85.xml
```
