# To Use

A form can submit an `email` via GET to this plugin and it will add the email
to the MailPoet list specified by `list_id`.

## Example

	?form_to_mailpoet=true&email=email@email.com&redirect_to=/free-trial/&list_id=10&admin_email=admin@email.com

### Multiple Lists

You can use something like the below to add the email to multiple lists.

	?form_to_mailpoet=true&email=email@email.com&redirect_to=/free-trial/&list_id=10,15&admin_email=admin@email.com

## GET Parameters

### form_to_mailpoet (Required)

This will tell the plugin to activate. Set to any value.

### email (Required)

This is the email that should be added to the list. 

### redirect_to

The url to go to when it's done.

### list_id (Required)

You can find the ID of the list by editing it using MailPoet and getting
the `id` from `http://example.com/wp-admin/admin.php?page=wysija_subscribers&id=15&action=editlist`

You can also supply a comma separated list of id's: `&list_id=10,15`

### admin_email (Required)

The admin email in the settings. This is a security measure to ensure that 
big bad hackers can't just add emails to your lists, they have to know the 
admin email, which only you should know.

# Changelog