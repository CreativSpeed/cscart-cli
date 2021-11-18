# CS-Cart CLI
CSCart & Multivendor Command Line Tools for Developers

## Usage
a command line tool to help Cs-Cart & Multi-Vendor developers scaffold add-on and theme for easy developemnt.

### Installing
You'll need [Composer](https://getcomposer.org) installed in your system. Check out its [installation guide](https://getcomposer.org/doc/00-intro.md#globally) if you haven't done that before.


When the Composer is installed, just execute this command in your console:
```bash
$ composer global require "creativspeed/cscart-cli"
```

### Executing commands
```bash
$ cscart command:name
```
### Command list
##### addon:new
Create new add-on files, allowing you to develop and store add-on files in a separate Git repository.

```
Description:
  Scaffold a new Cs-Cart & multi-vendor Add-on

Usage:
  addon:new [options] [--] <name> [<path>]

Arguments:
  name                  Add-on name [ID]
  path                  Add-on folder location (optional)

Options:
  -c, --controller      create Add-on controller
  -l, --local           change or add Add-on languages
  -t, --theme           add var/themes_repository
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
      --env[=ENV]       The environment the command should run under
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```

##### addon:link
Symbolic Link Add-on to CSCart & Multivendor for better Add-on development
```
Description:
  symbolik linking cs-cart Add-on to cs-cart installation for better and easy development

Usage:
  addon:link [options] [--] <addon> <cart>

Arguments:
  addon                 path to Add-on directory
  cart                  path to Cs-cart/multivendor installation directory

Options:
  -t, --templates       take the add-on templates from "var/themes_repository"
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
      --env[=ENV]       The environment the command should run under
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```
##### addon:unlink
Delete the addon-on symbolic link from your CSCart & Multivendor installation
```
Description:
  delete symbolik linking cs-cart Add-on from cart installation

Usage:
  addon:unlink [options] [--] <addon> <cart>

Arguments:
  addon                 path to Add-on directory
  cart                  path to Cs-cart/multivendor installation directory

Options:
  -t, --templates       take the add-on templates from "var/themes_repository"
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
      --env[=ENV]       The environment the command should run under
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```
