1. What does this script do (dad.php)?
	It first prints out the name in the query parameter, and then tells a joke by initiating a request to the dad joke page.
	1. Where does user input come from?
		From the get request parameter.
	1. How is user input used?
		It gets printed out without being sanitized/validated.
2. What are the parts of the URL?
	It consists of a 'name' parameter.
	1. Where is the attack payload?
		It is embedded in the url.
	1. What is the div tag doing?
		It hides everything after it.
3. What is displayed on this web page?
	A fake authentication page.
4. Describe an attack scenario that takes advantage of dad.php.
	1. Who controls the malicious code?
		The attacker Mallory.
	1. Where is the malicious code stored?
		In the url.
5. How could dad.php be changed to fix the vulnerability?
	Sanitize user input before putting it on the page.
	1. What PHP functions could you use to fix it? You might find the PHP manual to be helpful: https://secure.php.net/manual/en/book.strings.php (Links to an external site.)Links to an external site.
		strip_tags($user_input)
		
6. What does this script do (shopping.php)?
	It keeps track of a shopping list.
	1. Where does user input come from?
		It came from an input bar on the page. 
	1. How is user input used?
		It is used to insert new shopping items.
7. What is shoppingitems.txt and why are we running chmod on it?
	It is a textfile that acts as a database. Chmod allows the program to write to the file.
8. What is the attack payload (what does it do)?
	It redirects the page to a youtube page.
	1. How does it do it?
		It injects to the page a javascript code, which gets executed whenever the page is loaded.
9. Describe an attack scenario that takes advantage of shopping.php.
	1. Who controls the malicious code?
		The attacker.
	1. Where is the malicious code stored?
		In the database.
10. How could shopping.php be changed to fix the vulnerability?
	Validate/sanitize user input! Strip out all invalid characters.
