# moodle_block_teams_sync
teams sync block for moodle

## Description
This plugin has been developed to support Moodle-Teams integration.  
Add Teams synchronization block to your course and click the "Synchronize" button, 
then a team of the course will be automatically created by the plugin (The course ID should be provided).

## Install
You can install this plugin as like normal block plugins.  
Deploy "teams_sync/" under the blocks of Moodle, and then you can access the management page.

## Update (Jun.6.2020)
Added the function to canceling Teams synchronization. When you click 'Turn off' in Teams sync block,
o365 group is deleted and Team of course is deleted too.

## Attention
- Install the [Microsoft office 365 Moodle plugin](https://moodle.org/plugins/local_o365) first
- Set the synchronization item of the plugin to "Customize"
- We do not recommend multiple synchronizations over multiple courses at a time
