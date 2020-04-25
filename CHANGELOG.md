# Single Cat Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## 1.2.2 - 2020-04-23

### Fixed

- Added CategoryInterface to fix GraphQL not working with SingleCat field

## 1.2.1 - 2019-02-17

### Fixed

- Prevent error when CraftQL plugin is not installed.

## 1.2.0 - 2019-02-16

### Added

- Setting to display a blank initial option in the drop-down, allowing for no category to be selected (thanks to [carlcs](https://github.com/carlcs)).
- CraftQL support. It works the same as with a native Categories field.

### Improved

- If the previously-selected category has since been disabled, editing the entry will result in no category being selected, rather than the first in the list.

## 1.1.0 - 2019-01-26

### Added

- Compatibility with Craft 3.1.

## 1.0.3 - 2018-11-08

### Fixed

- Improved reliability with loading categories.

## 1.0.2 - 2018-11-07

### Fixed

- Bug when multiple category groups exist.

### Added

- Ability to select a different category in each site.

## 1.0.1 - 2018-11-04

### Fixed

- Error when field value is null.

## 1.0.0 - 2018-10-29

### Added

- Initial release.
