# OpenSimMaps (standalone)

The map tool for OpenSimulator, to display the grid map on a website, for

- standalone use
- integration with [Flexible Helper Scripts](https://github.com/GuduleLapointe/flexible_helper_scripts)
- (upcoming) integration with [w4os WordPress Interface for OpenSimulator](https://w4os.org)

This is a modified version of hawddamor/opensimmaps. The modifcations from the original project are only related to file locations and some variable names. If you use OpenSim Redux web interface, it might be better to stick with hawddamor's version.

- Support this project: <https://magiiic.com/support/OpenSimMaps>

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

More information on original project and authors in README and LICENSE files.
