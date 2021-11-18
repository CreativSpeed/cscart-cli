# CS-Cart CLI
CSCart & Multivendor Command Line Tools for Developers

## Usage
a command line tool to help Cs-Cart & Multi-Vendor developers scaffold add-on and theme for easy developemnt.

### Installing
You'll need [Composer](https://getcomposer.org) installed in your system. Check out its [installation guide](https://getcomposer.org/doc/00-intro.md#globally) if you haven't done that before.


When the Composer is installed, just execute this command in your console:
```bash
$ composer global require "creativspeed/**"
```

### Executing commands
```bash
$ cscart command:name
```
### Command list
##### addon:new
Create new add-on files, allowing you to develop and store add-on files in a separate Git repository.

```
$ cscart addon:new --help
Usage:
  addon:new [options] [--] [<name> [<path>]]

Arguments:
  name                  Add-on name [ID]
  path                  Add-on path (optional)

Options:
  -c, --controller      create Add-on controller
  -l, --language        change Add-on language, default english
  -s, --schema          create Add-on schema layout
  -t, --theme           add var/themes_repository
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
      --env[=ENV]       The environment the command should run under
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```
