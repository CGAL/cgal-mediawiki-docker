<?php

# This file was automatically generated by the MediaWiki installer.
# If you make manual changes, please keep track in case you need to
# recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# http://www.mediawiki.org/wiki/Manual:Configuration_settings

# If you customize your file layout, set $IP to the directory that contains
# the other MediaWiki files. It will be used as a base to locate files.
if( defined( 'MW_INSTALL_PATH' ) ) {
	$IP = MW_INSTALL_PATH;
} else {
	$IP = dirname( __FILE__ );
}



$path = array( $IP, "$IP/includes", "$IP/languages" );
set_include_path( implode( PATH_SEPARATOR, $path ) . PATH_SEPARATOR . get_include_path() );

#require_once( "$IP/includes/DefaultSettings.php" );

# If PHP's memory limit is very low, some operations may fail.
ini_set( 'memory_limit', '20M' );

if ( $wgCommandLineMode ) {
	if ( isset( $_SERVER ) && array_key_exists( 'REQUEST_METHOD', $_SERVER ) ) {
		die( "This script must be run from the command line\n" );
	}
}
## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename         = "CGAL develop wiki";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
$wgScriptPath       = "";
# Virtual path. This directory MUST be different from the one used in $wgScriptPath
$wgArticlePath = '/wiki/$1';
# http://www.mediawiki.org/wiki/Manual:$wgUsePathInfo
# Whether to use 'pretty' URLs, e.g. index.php/Page_title
$wgUsePathInfo = true;

$wgScriptExtension  = ".php";

## For more information on customizing the URLs please see:
## http://www.mediawiki.org/wiki/Manual:Short_URL

$wgEnableEmail      = true;
$wgEnableUserEmail  = true;

$wgEmergencyContact = "Laurent.Rineau@geometryfactory.com";
$wgPasswordSender = "root@cgal.geometryfactory.com";
$wgPasswordSenderName = "CGAL Developers Wiki Administrator";

## For a detailed description of the following switches see
## http://www.mediawiki.org/wiki/Extension:Email_notification 
## and http://www.mediawiki.org/wiki/Extension:Email_notification
## There are many more options for fine tuning available see
## /includes/DefaultSettings.php
## UPO means: this is also a user preference option
$wgEnotifUserTalk = true; # UPO
$wgEnotifWatchlist = true; # UPO
$wgEmailAuthentication = true;

## Database settings
$wgDBtype           = "mysql";
$wgDBserver         = "mysql";
$wgDBname           = "cgalwikidb";
$wgDBuser           = "cgalwiki";
$wgDBpassword       = "PASSWD";

# MySQL specific settings
$wgDBprefix         = "cgal_members_";

# MySQL table options to use during installation or update
#$$wgDBTableOptions   = "TYPE=InnoDB";
#  Use default. --Laurent Rineau 2011/11/30

# Experimental charset support for MySQL 4.1/5.0.
$wgDBmysql5 = false;

# Postgres specific settings
$wgDBport           = "5432";
$wgDBmwschema       = "mediawiki";
$wgDBts2schema      = "public";

## Shared memory settings
$wgMainCacheType = CACHE_NONE;
$wgMemCachedServers = array();

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads       = true;
$wgUseImageMagick = true;
$wgImageMagickTempDir = "/var/www/html/images/tmp";
$wgImageMagickConvertCommand = "/usr/bin/convert";
$wgUploadDirectory       = "/var/www/html/images";
$wgUploadPath       = "/images";

//To be able to send emails.
$wgSMTP = array(
        'host' => 'aspmx.l.google.com',
        'IDHost' => 'CGAL Wiki',
        'port' => '25',
        'username' => false,
        'password' => false,
        'auth' => false
);

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "en_US.utf8";

## If you want to use image uploads under safe mode,
## create the directories images/archive, images/thumb and
## images/temp, and make them all writable. Then uncomment
## this, if it's not already uncommented:
# $wgHashedUploadDirectory = false;

## If you have the appropriate support software installed
## you can enable inline LaTeX equations:
#$wgUseTeX           = true;
# http://www.mediawiki.org/wiki/Manual:$wgUseTeX
# Deprecated.
#
# Use http://www.mediawiki.org/wiki/Extension:Math instead
require_once("$IP/extensions/Math/Math.php");
// Set MathML as default rendering option
$wgDefaultUserOptions['math'] = 'mathml';
$wgMathFullRestbaseURL= 'https://api.formulasearchengine.com/';
#$wgTexvc = "$IP/math-texvc/texvc";
#$wgMathTexvcCheckExecutable = "$IP/math-texvc/texvccheck";

$wgLocalInterwiki   = $wgSitename;

$wgLanguageCode = "en";

$wgProxyKey = "3228af4b1589702ba673346685d2afbcdac500d5a2da385703527575e45822e3";

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'standard', 'nostalgia', 'cologneblue', 'monobook':
$wgDefaultSkin = 'monobook';
# Enabled skins.
# The following skins were automatically enabled:
wfLoadSkin( 'CologneBlue' );
wfLoadSkin( 'Modern' );
wfLoadSkin( 'MonoBook' );
wfLoadSkin( 'Vector' );
## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
# $wgEnableCreativeCommonsRdf = true;
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "";
$wgRightsText = "";
$wgRightsIcon = "";
# $wgRightsCode = ""; # Not yet used

$wgDiff3 = "/usr/bin/diff3";

# When you make changes to this configuration file, this will make
# sure that cached pages are cleared.
$configdate = gmdate( 'YmdHis', @filemtime( __FILE__ ) );
$wgCacheEpoch = max( $wgCacheEpoch, $configdate );
	

$wgLogo ="/img/cgal-dev-wiki-logo2.png";
$wgFavicon = '/img/cgal-dev-wiki-favicon.png';

# See ConfirmAccount extension below
#$wgGroupPermissions['*'    ]['createaccount']   = true;
$wgGroupPermissions['*'    ]['read']            = true;
$wgGroupPermissions['*'    ]['edit']            = false;
$wgGroupPermissions['*'    ]['createpage']      = false;
$wgGroupPermissions['*'    ]['createtalk']      = false;
$wgGroupPermissions['*'    ]['writeapi']         = false;

$wgGroupPermissions['user' ]['createtalk']       = false;
$wgGroupPermissions['cgaleditor' ]['createtalk']       = true;

/** This is a flag to determine whether or not to check file extensions on upload. */
$wgFileExtensions = array('svg', 'png', 'gif', 'jpg', 'jpeg', 'doc', 'xls', 'mpp', 'pdf', 'ppt', 'tiff', 'bmp', 'docx', 'xlsx', 'pptx', 'ps', 'psd', 'swf', 'fla', 'mp3', 'mp4', 'm4v', 'mov', 'avi', 'txt', 'h', 'cpp', 'tgz', 'tar.gz');
$wgCheckFileExtensions = true;

/**
 * If this is turned off, users may override the warning for files not covered
 * by $wgFileExtensions.
 */
$wgStrictFileExtensions = false;

# Enable subpages in the main namespace
$wgNamespacesWithSubpages[NS_MAIN] = true;

/**
 * Namespace aliases
 * These are alternate names for the primary localised namespace names, which
 * are defined by $wgExtraNamespaces and the language file. If a page is
 * requested with such a prefix, the request will be redirected to the primary
 * name.
 *
 * Set this to a map from namespace names to IDs.
 * Example:
 *    $wgNamespaceAliases = array(
 *        'Wikipedian' => NS_USER,
 *        'Help' => 100,
 *    );
 */
$wgNamespaceAliases = array(
   'File' => NS_IMAGE,
);

/** Use RC Patrolling to check for vandalism */
$wgUseRCPatrol = false;

/** Use new page patrolling to check new pages on Special:Newpages */
$wgUseNPPatrol = false;

# Namespace for CGAL Editors
# create namespace
define("NS_EDITORS",100);
define("NS_EDITORS_TALK",101);
$wgExtraNamespaces[NS_EDITORS] = "Editors";
$wgExtraNamespaces[NS_EDITORS_TALK] = "Editors_talk";
# protect namespace
$wgNamespaceProtection[NS_EDITORS] = Array("editeditors");
$wgNamespacesWithSubpages[NS_EDITORS] = true;
$wgGroupPermissions['*']['editeditors'] = false;
$wgGroupPermissions['cgaleditor']['editeditors'] = true;
$wgContentNamespaces[] = NS_EDITORS;

$messages['group-cgaleditor'] = 'CGAL Editors';
$messages['right-editeditors'] = 'Edit pages of the Editors: namespace';

# Extension RenameUser
require_once("$IP/extensions/Renameuser/Renameuser.php");

# Extension http://www.mediawiki.org/wiki/Extension:DiscussionThreading
require_once("$IP/extensions/DiscussionThreading/DiscussionThreading.php");

# Extension http://www.mediawiki.org/wiki/Extension:SyntaxHighlight_GeSHi
wfLoadExtension( 'SyntaxHighlight_GeSHi' );
$wgSyntaxHighlightDefaultLang = "cpp-qt";

/** Should we allow the user's to select their own skin that will override the default? */
$wgAllowUserSkin = false;

/**
 * Enable interwiki transcluding.  Only when iw_trans=1.
 */
$wgEnableScaryTranscluding = true;

/**
 * Filename for debug logging. See http://www.mediawiki.org/wiki/How_to_debug
 * The debug log file should be not be publicly accessible if it is used, as it
 * may contain private data. 
 */
# $wgDebugLogFile         = '/tmp/wiki-log';

/** Make users use autonumbering by default */
$wgDefaultUserOptions ['numberheadings'] = 1;

/** Determines if the mime type of uploaded files should be checked */
$wgVerifyMimeType= false;

# Comment unless you want read-only mode
#$wgReadOnly = 'Server maintenance. --Laurent Rineau, 2012/05/10';
$wgReadOnlyFile="/etc/wikis/readonly.txt";

$wgLocaltimezone = 'Europe/Paris';

require_once("$IP/extensions/Interwiki/Interwiki.php");
$wgGroupPermissions['*']['interwiki'] = false;
$wgGroupPermissions['sysop']['interwiki'] = true;

# Bureaucrat settings
$wgGroupPermissions['bureaucrat']['delete'] = true;
$wgGroupPermissions['bureaucrat']['block'] = true;
$wgGroupPermissions['bureaucrat']['editinterface'] = true;

# Extension UserMerge
require_once( "$IP/extensions/UserMerge/UserMerge.php" );
$wgGroupPermissions['bureaucrat']['usermerge'] = true;

# Disable reading by anonymous users
$wgGroupPermissions['*']['read'] = false;

# Extension ConfirmAccount
require_once("$IP/extensions/ConfirmAccount/ConfirmAccount.php");
$wgMakeUserPageFromBio = true;
$wgAutoWelcomeNewUsers = true;
$wgUseRealNamesOnly = true;
$wgAutoUserBioText = "(This text was send by the user for his/her account creation request.)";
$wgConfirmAccountContact = "info@cgal.org";
$wgAllowRealName = true;
$wgAccountRequestToS = false;
$wgWhitelistRead = array('Special:RequestAccount');
$wgGroupPermissions['cgaleditor']['confirmaccount'] = true;
$wgAllowAccountRequestFiles = false;
$wgAccountRequestMinWords = 5;
$wgConfirmAccountRequestFormItems['UserName']['enabled'] = false;
$wgConfirmAccountRequestFormItems['TermsOfService']['enabled'] = false;
$wgConfirmAccountRequestFormItems['Biography']['minWords'] = 20;

# SVG support
$wgMaxShellMemory = 512000;
$wgAllowTitlesInSVG = true;
$wgSVGConverter = 'ImageMagick';
$wgSVGConverters = array(
			 'ImageMagick' => '/usr/bin/convert -background white -geometry $width $input PNG:$output',
			 'rsvg' => '$path/rsvg -w$width -h$height $input $output',
			 );

# http://www.mediawiki.org/wiki/Extension:ExternalLinks
#require_once( "$IP/extensions/ExternalLinks/ExternalLinks.php" );
#$wgELvalidationMode = 'cURL';

# Thanks to http://stackoverflow.com/questions/13349142/disabling-user-accounts-in-mediawiki
# https://www.mediawiki.org/wiki/Manual:$wgBlockDisablesLogin
$wgBlockDisablesLogin = true;

# http://www.mediawiki.org/wiki/Extension:ParserFunctions
require_once "$IP/extensions/ParserFunctions/ParserFunctions.php";

# Composer
require __DIR__ . '/vendor/autoload.php';

# Semantic Web
#enableSemantic('cgal.geometryfactory.com');
wfLoadExtension( 'PageForms' );

# https://semantic-mediawiki.org/wiki/Help:Configuration#smwgQConceptCaching
$mwgQConceptCaching = CONCEPT_CACHE_NONE;

# https://semantic-mediawiki.org/wiki/FAQ#Why_doesn.27t_data_I_have_just_added_show_up_in_queries.3F
# https://www.mediawiki.org/wiki/Extension:MagicNoCache
require_once "$IP/extensions/MagicNoCache/MagicNoCache.php";

# http://www.mediawiki.org/wiki/Manual:Job_queue#Updating_links_tables_when_a_template_changes
$wgJobRunRate = 10;

# http://www.semantic-mediawiki.org/wiki/Pass_values_to_a_form_in_order_to_dynamically_change_its_content_/_layout
# https://www.mediawiki.org/wiki/Extension:UrlGetParameters
require_once( "$IP/extensions/UrlGetParameters/UrlGetParameters.php" );

