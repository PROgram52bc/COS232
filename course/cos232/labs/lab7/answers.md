1. Questions about the application:
	* What is the programming language used?
		php.
	* What is the database used?
		Maria Database.
2. Questions about the database schema:
	* How many tables are in the database?
		two.
	* Based on the data in the DB, how might the tables linked together?
		through the user id.
3. What does the UNION operator do?
	It combines the results of two query.
4. What is the resulting query?
	The combination of the two query results.
5. What CIA attribute is compromised?
	Confidentiality.
6. Why does the order of the fields matter?
	Because SQL unions tables in the order, and only the certain field in the database was displayed.
7. How many queries are run on the database? How, isn’t there only one PHP query executed?
	Two. In the php code, there is only one string, but the single string can contain multiple queries separated by a semicolon.
8. What are the resulting queries?
	SELECT * FROM transactions WHERE userid = 2; INSERT INTO transactions VALUES (NULL, 'w00t', 1000000, 2);
9. What CIA attribute is compromised?
	Integrity.
10. What are the resulting queries?
	SELECT * FROM transactions WHERE userid = 2; DROP TABLE transactions;
11. What CIA attribute is compromised?
	Availability and Integrity.
12. Do the attacks work? Why?
	No, because user input is no longer taken as a part of the query string and executed.
