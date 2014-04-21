# To Use

## Installation

First, install this as a WordPress plugin.

## What it Does

A form can submit an `email` paramerter (among others, see below) 
via GET to this plugin (see `form_to_mailpoet` below) and it will add 
the email specified to the MailPoet list specified by `list_id`.

## Example

Just have your form post to `/` via GET / POST with the following parameters:

	/?form_to_mailpoet=true&email=email@email.com&redirect_to=/free-trial/&list_id=10&admin_email=admin@email.com

## GET Parameters

### form_to_mailpoet (Required)

This will tell the plugin to activate. Set to any value, `true` is good.

### email (Required)

This is the email that should be added to the list(s).

### list_id (Required)

You can find the ID of the list by editing it using MailPoet and getting
the `id` from `http://example.com/wp-admin/admin.php?page=wysija_subscribers&id=15&action=editlist`

You can also supply a comma separated list of id's: `&list_id=10,15`

### admin_email (Required)

The admin email in the settings. This is a security measure to ensure that 
big bad hackers can't just add emails to your lists, they have to know the 
admin email, which only you should know.

### redirect_to

The url to go to when it's done.

# Changelog

## 1.0

- A working version of the plugin :)