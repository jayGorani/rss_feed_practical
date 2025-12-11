**📡 RSS Feed Practical — CodeIgniter 3**

	This project demonstrates a practical implementation of RSS Feeds using CodeIgniter 3.
	It covers feed fetching, parsing, and rendering using CI3’s MVC structure.

**🖥️ Server Requirements**

| Component       | Version / Requirement                                              |
| --------------- | ------------------------------------------------------------------ |
| **CodeIgniter** | 3.1.13                                                             |
| **PHP**         | 7.4.33                                                             |
| **MySQL**       | 5.7+                                                               |
| **Apache**      | Must have `mod_rewrite` enabled                                    |
| **Extensions**  | `CURL` and `OPENSSL` must be enabled for third-party API handshake |

**📁 Project Structure & Setup — CodeIgniter 3**
	**✅ Project Directory**
	**Keep the main project folder name as : rss_practical**
	
	If you change this directory name, make sure to update the following configurations:

**🔧 1. Base URL**
	
	Update the base URL in :
	
	 - application/config/config.php

	Modify the base url :
	
	 - $config['base_url'] = 'http://localhost/rss_practical/';
	
**🔧 2. Root .htaccess**
	
	If you rename the** main folder, update the rewrite base accordingly in your root-level .htaccess.**
	
**🔧 3. Database Configuration**

	Update database credentials here:
	
	- application/config/database.php

	Example :
	
	'hostname' => 'localhost',
	'username' => 'your_db_user',
	'password' => 'your_db_password',
	'database' => 'rss_feeds',

