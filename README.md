# Space48_LinkshareTracking
Linkshare Affiliation Tracking Module - Supersedes the Space48_Linkshare module.

The linkshare mID and the correct URL need to be set in order for the module to be enabled.  The Pixel Url will depend upon whether the success page is HTTP or HTTPS.  The default Pixel Url is http.

The Cookie Lifetime can also be changed in the Admin Config.  The Default is 30 days.

The module relies upon jQuery, in particular the jQuery cookie plugin (which is included in the skin/.../js folder) however, the main jQuery file is not included as it is anticipated that this is already installed.  jQuery is called by "jQuery" not "$j" etc...

