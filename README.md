The Eternity API semi-official PHP SDK is a simple way to use the <a href="http://api.eternityincurakai.com">Eternity Incurakai API</a>.
<h2>How to use</h2>
First, include the Eternity API PHP SDK:
<code>require './eternityapi.php';</code>
Next, create a new eternityApi object:
<code>$eternity = new eternityApi;</code>
Now, you can call any Eternity API functions by doing:
<code>$eternity->[function name]();</code>
For more information, see the <a href="http://api.eternityincurakai.com/documentation">Eternity API Documentation</a>.  Functions are named by the URL-encoded tag that is found on the end of the "URL" field, for example status, authenticate, getnumberofusers, etc.  One exception is status-image, because dashes are not allowed in PHP functions; this is named statusimage.
<h2>Errors</h2>
If there is an error, the function will return FALSE, and the error information will be loaded into $ei_error.  Note that authenticate also returns false if the password is incorrect, but does not load the information into $ei_error.
Here is a sample of error checking:
<code>
if(isset($ei_error))
{
	echo 'Error number '.$ei_error->err_num.': '.$ei_error->err_desc;
}
else
{
	echo 'Authentication failed.  Incorrect username or password.';
}
</code>