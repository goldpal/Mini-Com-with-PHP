[Integralist](http://www.integralist.co.uk/) - Mini-Com
================================

Description
-----------

Mini-Com (short for 'minifier' and 'combiner') is a PHP script which takes in a list of comma separated filenames (without the extension) and then combines them into one file and minifies the results using [YUI Compressor](http://developer.yahoo.com/yui/compressor/).

I had originally written a group of `Regular Expressions` for compressing the CSS code but I've now decided that as we're using YUI Compressor for the JavaScript it makes sense to just use it for the CSS as well.

TODO
----

The following items are on the TODO list:

* Integrate some form of cache mechanism so that the YUI Compressor isn't being called on every single page view.

* Clean up the API (some how?) as I personally feel Query String data is [fugliy](http://www.urbandictionary.com/define.php?term=fugly&defid=3859324) as hell.

Server Set-up
-------------

It's worth noting that when running this code on an Apache server everything runs great. But when I took this script into a work environment where we have a dedicated Windows 2003 Server the code just refused to work (and to make things worse the YUI Compressor wasn't feeding back any errors of any kind - just an empty Array).

It turns out that (for us any way, your usage may vary depending on your Windows set-up...) our server engineers had to allow read + execute permissions for a Plesk user `psacln` to the directory where Java was installed. AND they also enabled ASP.NET permissions for the inetpub directories.

It took ages for them to figure it out, so if you do try and use this on a Windows server then hopefully some of this information may help you.