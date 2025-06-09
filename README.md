# OpenSimMaps (standalone)

The web map tool for OpenSimulator, for

- standalone use
- or integration with

  - [Flexible Helper Scripts](https://github.com/GuduleLapointe/flexible_helper_scripts)
  - legacy OpenSimWiRedux
  - (upcoming) [w4os WordPress Interface for OpenSimulator](https://w4os.org)

Support this project: <https://magiiic.com/support/OpenSimMaps>

## Features

- show grid map with region maptiles
- click to get a choice of teleport methods
- supports varregions
- supports multiple maps
- uses Google Maps v3 API

### New

- allow standalone use: include minimal settings, independant to other helpers or web interface
- include settings for integration with Flexible Helper Scripts
- separate settings file from the rest of the code: one for php (config.php), one for javascript (config.js)
- distribution now contains only example settings file, to alow smooth update without losing config
- added hop:// to teleport link choices

### TODO

- remove old API key probably belonging to one of the original developers
- ... and many other things whose details would be laborious (so much to do, so little time)
- please use [issues](https://github.com/GuduleLapointe/opensimmaps/issues) to request new features or report bugs

## Installation

- clone this folder inside your website documentroot, for example `/var/html/opensimmaps/` to make it accessible as <https://yourgrid.org/opensimmaps/> (you can rename it)
- Copy `config.php.example` as `config.php` and adjust settings (this helper only needs database credentials OPENSIM_DB_*)
- Copy `config.js.example` as `config.js` and adjust settings (particularly xlocations, ylocations, mapcenternames, hgdomains and hgports)
- make a soft link from the OpenSim maptile/00000000-0000-0000-0000-000000000000 folder to data/regions/, for example on linux (adjust to your setup):

  ```bash
  ln -s /opt/opensim-0.9.2.0/bin/maptiles/00000000-0000-0000-0000-000000000000 /var/html/opensimmaps/data/regions
  ```

  Alternatively, you can make data/regions/ folder and copy the maptiles in it, but it won't be updated automatically.

- Original readme specified to rather use Warp3DImageModule, but it is now the default. Your OpenSim.ini file should contain these settings:

  ```ini
  [Map]
    MapImageModule = "Warp3DImageModule"
    TextureOnMapTile = true
    DrawPrimOnMapTile = true
  ```

## Credits

Based on [hawddamor's opensimmaps](https://github.com/hawddamor/opensimmaps) (optimized for OpenSim Redux web interface).

This is a modified version of hawddamor/opensimmaps. The modifications from the original project are mainly related to file locations and some variable names.

More information on original project and authors in README and LICENSE files.
