=== WordPress Expert Agent XML Feed ===
Contributors: fseonline, freemius
Tags: expert agent, xml, feed, ftp, plugin, admin, cron, wp-cron
Tested up to: 5.5.1
Requires PHP: 5.6
Stable tag: 2.1.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WordPress Expert Agent XML Feed relies on the 3rd Party Expert Agent FTP to let you fetch the latest XML feed from your Expert Agent property feed.

== Description ==

### Effortlessly fetch your XML feed daily

WordPress Expert Agent XML Feed lets you fetch the latest XML feed from your 3rd Party [Expert Agent property XML feed](https://learningcentre.expertagent.co.uk/ea-manual/using-ea-data-in-your-website/the-two-methods/method-3-xml-feed).

From the admin screen you can:

* Add a Remote File
* Add the Remote User (FTP) login details
* Fetch the latest XML feed via the button ‘Fetch XML File’

### Pro — Built for Estate Agents

* Go to the **Pro** plan, and receive priority developer support.
* Highly recommended for **Estate Agents**
* Highly recommended for **web developers**, whose clients are Estate Agents

Go Pro, visit [WordPress Expert Agent XML Feed PRO](https://checkout.freemius.com/mode/dialog/plugin/6857/plan/11566/)

#### Usage

1. Go to the `Settings -> WordPress Expert Agent XML Feed` menu to manage settings for fetching the XML feed.
2. Input your Remote (FTP) Filename e.g. `properties.xml`, as well as your FTP Username and Password.
3. Click the button ‘Fetch XML File’ to connect to FTP, and download the latest copy of the XML feed.
4. A scheduler is already set up for you that will automatically download the XML feed every 24 hours.

### Gutenberg-Ready

This notice is to mention that you shouldn’t have any issues with this plugin and Gutenberg (as this plugin doesn’t have to relate with Gutenberg).

Go Pro, receive **always-there** support [WordPress Expert Agent XML Feed PRO](https://checkout.freemius.com/mode/dialog/plugin/6857/plan/11566/)

== Frequently Asked Questions ==

= How do I know that the XML feed is working? =

After you’ve specified your FTP server and login details which Expert Agent will have provided for you, you will have to click the button ‘Fetch XML File’.

Afterwards, a successful notice should appear, and will mention if the file download is successful.

= Is this the official plugin from Expert Agent? =

Unfortunately not yet, but we are working with Expert Agent to make sure that this plugin is kept robust.

= Where can I find my Remote URL, User, and Password login details? =

These are the FTP details given to you by Expert Agent.

You will need to create a Log Ticket through the Expert Agent Management system, informing them that you would like to ask for the XML feed FTP login details.

You can also email them at [support@expertagent.co.uk](mailto:support@expertagent.co.uk)

= The XML feed is now working, how do I extract its data? =

Unfortunately this plugin does not provide extracting the data.

It is up to you or your developer to extract the data, e.g. using PHP through [simpleXML](http://php.net/manual/en/simplexml.examples-basic.php).

= Why did you place the file under the Uploads folder? =

This is the proper place for a plugin to generate its files.

= Can you give me an example on how I can output/use the XML file? =

It is up to you or your developer to extract the data, e.g. using PHP through [simpleXML](http://php.net/manual/en/simplexml.examples-basic.php).

For example, let us get the ‘Property of the Week’:

`
<?php

	// First check if properties.xml file exists
	$upload_dir = wp_upload_dir();
	$propertiesXML = $upload_dir['basedir'] . '/wp-expert-agent-xml-feed/xml/properties.xml';
	if( file_exists( $propertiesXML ) ):

		// Let's get the XML file for the properties...
		$agency = new SimpleXMLElement( file_get_contents( $propertiesXML ) );

		$properties = $agency->branches->branch->properties;
		$property = $properties->property;

		// Let's get the first 'propertyofweek' we can find...
		// Then break apart once we find it!
		for ($i=0; $i < sizeof($property); $i++) {
			if( $property[$i]->propertyofweek == 'Yes' ) {
				$propertyofweek_price_text = $property[$i]->price_text;
				$propertyofweek_advert_heading = $property[$i]->advert_heading;
				$propertyofweek_main_advert = $property[$i]->main_advert;
				$propertyofweek_web_link = $property[$i]->web_link;
				$propertyofweek_picture_filename = $property[$i]->pictures->picture->filename;
				break;

			}

		}

 ?>
 <!-- Property of the week Title -->
 <h2><?php echo $propertyofweek_advert_heading; ?></h2>
`

= What is a cron job? =

It’s your web server’s built-in scheduler, so that you can action code depending on the time. WordPress has wp-cron.php which integrates WordPress with your server’s cron system.

= Where do I input the FTP Server? =

You don’t need to, as we have specified this for you as `ftp.expertagent.co.uk`.

== Screenshots ==
1. Add your FTP login details as provided by Expert Agent. Contact Expert Agent if you have forgotten your XML feed FTP login details.
2. Upon clicking the button ‘Fetch XML File’, you will find your downloaded file in your Uploads Folder.
3. Here is a visual of drilling down the folders towards the XML file.