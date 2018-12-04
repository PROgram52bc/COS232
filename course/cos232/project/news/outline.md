# Presentation Outline
## Title

Air Canada's mobile app suffered data breach involving passport number of 1.7 million of its users.

## Objective

Purpose: To present the facts, consequences, and technical details about Air Canada's data breach to my audience.

Audience: Average Students in class

## Questions

1. Why is mobile app in particular subjected to the data breach in this case? 

	"Because Aircanada.com accounts are not linked to Air Canada mobile app accounts, so those passwords don’t have to be changed."
	Separation of mechanisms.
2. Who did it?

	Not certain. In fact, they are not even certain whether it was a vulnerability in the system, or whether it was a login credential that was leaked by reused password/password sold underground. (https://www.helpnetsecurity.com/2018/08/30/air-canada-data-breach/)
3. How did the attacker gain such a big number of data just by accessing an unauthorized account? (was it a administrator's account?) Then how does resetting password help?

	Resetting password doesn't help! Only prevent normal users from accessing their data.
4. How did it happen?

	"We detected unusual login behaviour with Air Canada’s mobile App between Aug. 22-24, 2018."
	> Some thoughts on this: 
	>	1. It must have been an employee's account, possibly with high access privilege. Then letting individual users reset their passwords won't help.
	>	2. They should be able to track down which account it was.
5. How severe is the consequence?

	* Official Q&A (What did Air Canada say?)

		* "Is my passport information safe?
			* According to the Government of Canada’s passport website, the risk of a third party getting a passport in your name is low if you still have your passport, proof of citizenship, and supporting identity documents. Also according to the website, the Government of Canada cannot issue a new passport to anyone based on only the information found in a passport.


## Some thoughts on the flow of the presentation

> My name is ... Talk about Air Canada Mobile App Data Breach
> Before start, I just want to make sure that we are on the same page by defining two terms.

* Air Canada
	* the largest airline company in Canada, found in 1937. (definition tag)
* Data Breach
	* a confirmed incident in which sensitive, confidential or otherwise protected data has been accessed and/or disclosed in an unauthorized fashion. (definition tag)

> So in this presentation, I will 
> * first present a bare-minimum of what happened, according to Air Canada's official notice to users; 
> * and then, talk about victims of this event, as well as some potential ways that they might be affected. 
> * In the third section, I will turn to the technical side, try to answer questions like "How did it happen", and evaluate Air Canada's response.
> * At last is the conclusion, including some take home message for me, and for all of us.

*(2-3 mins till here)*

1. What happened? (Using references from Air Canada directly)

	> I have a short video that briefly addresses the situation and hopefully it will provide some context for this event. (video tag)

	*(+1.5 min)*

	> On Aug 28, Air Canada posted an article on their official website, addressing this data breach.
	* detected unusual log in behavior between Aug. 22-24, 2018, that might have compromised 1.7 million Air Canada mobile App user profiles.
	* Following Personal informations might have been improperly accessed: Aeroplan number, Passport number, NEXUS number, Known Traveler Number, gender, birthdate, nationality, passport expiration date, passport country of issuance and country of residence.
	* As a response, Air Canada locked all Air Canada mobile App accounts to protect customers’ data.
	* Potentially affected customers were informed by email starting Aug. 29

	*(+2 mins)*

1. Consequence.
	* Who are affected? 
		* Air Canada Mobile App Users, especially those who stored critical information in the app.
	* What security principle is threatened? 
		* Confidentiality, because their personal information was disclosed in an unauthorized way.

	*(+1 mins)*

	* How can they be affected?
		* Identity Fraud
			* Identity fraud happens when a fraudster pretends to be an innocent individual to buy a product or take out a loan in their name.
			> Because a lot of businesses or organizations requests passport number but not necessarily the presence of the physical documents, it creates an opportunity for criminals to conduct illegal behaviors in the name of someone else.
			> And... it can really make the victims suffer from crimes that they didn't commit.
		* Undermining the legitimacy of passport numbers
			> And if this kind of data breach continues to happen, it is likely that passport numbers will no longer be a trustworthy means to verify identity.
			* "But we're at the point where so much sensitive data is being released via such breaches that we can no longer assume that mere knowledge of what is written in a passport is sufficient to verify ID online." (https://www.bbc.com/news/technology-45349056, by The City of London's Action Fraudteam)

	*(+2 mins)*

1. Technical details
	> I think all the technical details boil down to one big question, which is:

	* How did the breach happen?
		> First of all, the nature of this breach is almost certain to be a deliberate attack. Although we do not know the identity of the attackers, there are several possibilities that tempted to explain how the breach happened.

		> Before diving into the possibilities, here is just a little background information about Air Canada's password system.
		> It turns out that Air Canada's mobile app uses a weak password system that limits the password to only 6-10 characters with only letters and numbers.
		> According to Amit Sethi (a security consultant at Synopsys) "Many users will choose short and easily guessable passwords," 
		> I kind of agree with her, because if that was me, I would probably choose a password like 123456 or something similar, and that creates a great threat to account security.

		> So, one possibility is that the attacker used brutal for ce attack.
		1. Possibility 1: Brutal force attack (Unlikely)

		> But it will still take a lot of time to break so many (1.7 million) passwords using brutal force, before being detected.
		1. Possibility 2: Attackers tempted passwords from black market or attempted with passwords that users reused on other sites. (More likely)
		> It might just be email/passwords pairs that were reused on other sites, and this will take much less time and risk than a simple brutal force attack.

		1. Possibility 3: Vulnerability in the system (More likely)
		> And there is another possibility.
		> it might also be an attack that have taken advantage of existing vulnerabilities in the system, like the one we read about the compiler, where there is a magic password or something similar.
		> So this guy named Chester Wisniewski, who is a principal research scientist at cybersecurity firm Sophos, said: "I suspect hackers stumbled across a bug in the API."

	*(+3 mins)*

	> Unwanted
	>	Because it's limited to only eight characters, "their password policy was rather antiquated which suggests they weren't doing it right to begin with," he said. "If you stored them correctly you wouldn't do that."
	>	* Detected...
	>		1. Intrusion detection system.
	>		> So how did they detect the data breach? They didn't mention anything technical in their official website, but I think it is very probable that they had an intrusion detection system, like described in our textbook, which will send alerts when users behaviors are abnormal.
	>	* What did it do well?
	>		* Good that it noticed users quickly.
	>		* Separation of mechanism (Mobile and website with different database)
	>	* What did it do terrible?
	>		* Asking for resetting password. (Availability)
	>			* It was mentioned that Air Canada uses a weak password system. 
	>		> Perhaps introduce who did it and how did it happen here.
	>		> Q: Did the attacker use a brutal force method to access 20,000 accounts or did he/she gained access of an administrator who has privilege to view those information? (See technical tag)
	>		* Absence of apology.
	>			* Not even saying "We apologize for this..." in official page.
	>			* Instead, spent a lot of words saying that their 
	>			* "Oh good: my credit card is totally safe, but all the stuff that can be used to pretend to be me and get more of my money is at risk. What a relief." (https://boingboing.net/2018/08/29/air-canada-hacked-user-info-s.html)
	>			* I am certainly not saying that Air Canada's security system is useless, but I do think that they should at least include an apology like "we are sorry for the failure of securing your data" in their notice. (A screenshot of emails sent to users maybe?)

1. Conclusion / take-home message
> As a word of ending..
> So when I first saw this news, I was kind of shocked, that 

	* Awareness that there is a risk in things that we use daily. (Air Canada mobile app) And I think having a mindset that evaluates risks in decision making processes is extremely valuable.

	*(+1 mins)*



## Interesting Facts 


* The app
	* More problems than security (Google Play)
		* Prompting to be offline when it's online.
		* Cannot retrieve information. 
		
		"I'm US citizen flying YYZ to YVR with no Aeroplane account and no need to create an account. I just wanted the app to retrieve the digital version of my flight...unfortunately the only feature that I am requesting does not work! Very basic input---Booking Reference and last name.... "Booking Reference not found. Please try again." Seems like a pretty basic request that unfortunately cannot be honored :( I even liked to see if there was a US English version, but to no avail.)"

		* Keep prompting to change password.


## Requirments
- [x] Presenter provided slides or handouts (1.0 pts) 

- [x] Event occurred in past 24 months (1.0 pts)

- [x] Specified if it is an attack or a vulnerability (2.0 pts)

	Integrate it into the presentation.

- [x] Included technical description of the attack/vulnerability (2.0 pts)

	Perhaps someone breaking into staff account and accessed info.
	Integrate it into the presentation.

- [x] Indicated which security CIA principle was violated/vulnerable?  (2.0 pts)

	Integrate it into the presentation.

	* Confidentiality: Password numbers were improperly accessed.

	* Availability: All users were locked down until they reset password. "As an additional security precaution, we have locked all Air Canada mobile App accounts to protect our customers’ data.” 

- [x] Identified who was the victim or potential victim (2.0 pts)

	The users of Air Canada App.
	
	Integrate it into the consequence section.

- [x] If an attack is described, who was the attacker? If vulnerability, who discovered it?  (2.0 pts)

- [x] Described the broader impact (2.0 pts)

	Since many business requires Passport numbers without the presence of the original document, the leaked numbers can be misused (effectively with their corresponding names) in committing crimes on behalf of the victim. If this is the case, then it would be hard for the victim to vindicate himself as well as for the criminal to be identified.

- [ ] Presenter clearly understood the information presented (4.0 pts)

- [ ] Presentation was between 13 and 17 minutes (3.0 pts)
