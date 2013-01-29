Temp-Token - A Simple PHP Temporary Token Generator
===================================================

Why?
----

I needed a temporary password reset token generating when a user 'forgot their password'.
Although a nice feature, pulling in dependencies for storage seemed overkill and decided
to just spin up a quick library that generated a very unique token (it can be made even more unique
via a 'salt' - something unique to that instance) and a expiration DateTime object for that token.

I suppose you could use it for any scenario requiring a temporary, guaranteed to expire token - my use case
was simply a password reset link token.

Usage:
--------

    require './vendor/autoload.php';

    // Instantiate a new TempToken object
    $temp_token = new MattKirwan\TempToken\TempToken();

	// Optionally set a unique salt (maybe a username?) for more randomness in the token
	$temp_token->set_unique_salt($username);

	// Optionally set the token lifetime in seconds - defaults to 1 hour (3600 secs)
	$temp_token->set_token_lifetime_secs(7200);

	// Generates a new token and token expiration
	$temp_token->generate_token();

	// Retrieve the token
	$token = $temp_token->get_token();

	// Retrieve a token expiration DateTime
	$token_expires = $temp_token->get_token_expiration();