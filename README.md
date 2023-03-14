# OpenSimMaps for Flexible Helper Scripts

This is a fork of [hawddamor's opensimmaps](https://github.com/hawddamor/opensimmaps) for integration with

- [Flexible Helper Scripts](https://github.com/GuduleLapointe/flexible_helper_scripts)
- and [w4os WordPress Interface for OpenSimulator](https://w4os.org).

There are very few changes, mainly related to config file locations.

## Installation

- clone this folder inside your website documentroot, for example `/var/html/opensimmaps/` to make it accessible as <https://yourgrid.org/opensimmaps/> (you can rename it)
- Copy `config.php.example` as `config.php` and adjust settings (this helper only needs database credentials OPENSIM_DB_*)
- Copy `config.js.example` as `config.js` and adjust settings (particularly xlocations, ylocations, mapcenternames, hgdomains and hgports)
- make a soft link from the OpenSim maptile/00000000-0000-0000-0000-000000000000 folder to data/regions/, for example on linux (adjust to your setup):

  ```
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

More information on original project and authors in README and LICENSE files.
