
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