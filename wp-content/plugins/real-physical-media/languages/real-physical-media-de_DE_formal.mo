��    U      �  q   l      0     1  �  J  �   	  �   �	      8
  �   Y
  �   �
  0  y  D   �     �  >      F   ?  �   �          *  s   ?  #   �     �      �            �     �   �  G   �     �        	     	   %  �   /     �  k     \  m  �   �  �   x  �   �  O   �  g   �  ,   >  =   k     �     �  *   �     �     	     &     ;     O  o   g  L   �     $  �   =  {   &  d   �       5     #   P  %   t  s   �  P     �   _  �   �  K   �  L   �    4  �  :  -      0   ?   +   p      �   V   �   �   !  �   �!     9"     U"  �   g"  ]   
#  g   h#  !   �#  f   �#  j   Y$  D   �$  3   	%  	   =%     G%  �  Y%      &'  ;  G'  �   �)  �   9*  <   �*  �   �*  �   �+  �  t,  V   �-     L.  @   a.  O   �.  �   �.     �/     �/  �   �/  (   ]0  #   �0  &   �0     �0  	   �0  &  �0  �   	2  T   �2     3     53     R3     f3  �   z3     Z4  �   s4  �  �4  �   �6  �   Q7  �   �7  Z   �8  �   �8  +   n9  7   �9     �9     �9  ;   �9     7:  +   P:     |:     �:     �:  y   �:  N   E;  &   �;  
  �;  u   �<  q   <=     �=  ?   �=  *   >  ,   ->  �   Z>  R   �>  �   :?  �   �?  S   �@  `   A  C  zA  T  �B  8   E  7   LE  /   �E     �E  s   �E  �   8F  �   �F      �G     �G  �   �G  [   �H  �   �H  #   xI  x   �I     J  M   �J  :   �J  	   K     (K     I                       0   T   9          P       C   3   &      ,         	   J          N   )   =             :   "           O   <      E      +   7      F   D       -       6   ?       $              %              Q   4   '           !   5   8       S   *          1                            .       /   @       G       2                U   M   
   B   H   A   K       #   (       R   >       L      ;            301 redirect delay (SEO) <br /><br />Before you reorder all files, move one file in your media library and go to the "Attachment Details" or "Edit Media" dialog of the file you last moved and click the "Move physically" button. Then check that the file is available at the new URL as expected.<br /><br />We recommend that you perform this manual check before you reorder all files, because special WordPress configurations rarely result in errors with the Media File Renamer handler. <strong>The physical file is not synchronized with the folder mentioned above.</strong> You can now synchronize and move the file from<br/>%1$s<br/>to<br/>%2$s <strong>You have not yet entered the license key</strong>. To receive automatic updates, please enter the key in "Enter license". Add %d files to queue for moving After moving the last file from a virtual folder, the physical folder should be deleted, but only if the subfolders are also empty and there is no lock file. After the last file or folder is moved from a virtual folder, both the virtual folder and the physical folder should get deleted. After you physically move a file, a 302 redirect (temporary forwarding) is set up. After a specified time (in hours) after the last update of the file location, a 301 redirect (permanent forwarding) is set up. This two-step process is necessary to avoid malfunctioning of caching plugins or CDN services. All cronjob URLs for all websites hosted in this WordPress instance: Apply new length Automatically transform special characters to latin characters Automatically transform the complete file and folder path to lowercase Create a physical folder after you create a virtual folder, even if the folder is still empty (creates a lock file %s to keep the physical folder). Cronjob service Delete all lockfiles Delete physical folders after deleting a virtual folder, but only if the physical folder and subfolders were empty. Exclude folder name from file path  File moving handler First shortcut path as file path Folders Free If the queue is empty, the Browser must regularly check if there is a new task in the queue. This value defines after how much seconds the browser will check again if a new task exists. The minimum allowed value is 1 second. If you have changed and saved the folder settings above, you must reflect the structure again, otherwise the new settings will only apply to new folder structures. If you set an upload prefix, this prefix is appended to the above path. Learn more about Cronjobs Learn more about lockfiles Lockfile  Lowercase Manual changes are automatically detected and a request to move the file physically will be sent immediately. For example, if you move a file by drag & drop, the file will be moved immediately. Move physically Moves new uploads directly to the correct physical folder, but existing files can also be moved physically. Moves the file physically to the location where the first shortcut is created. This is useful, for example, if you have a "All Images" folder and use the same images in several galleries, but do not want to have the "All Images" folder in the pathname. The WP/LR plugin works this way and you have to enable this option for the synchronized folder. Moving files is processed in a queue and in several requests to the server. The individual requests must be limited in time based on the configuration of PHP on your server. Note: You have activated automatic change detection. If you change the prefix, all files will be moved, which may take a few minutes.. Note: You have activated automatic change detection. If you change this option, all files will be moved, which may take a few minutes. Only applies if automatic change detection from Real Physical Media is enabled. Opening a single media file allows you to view physical location and manually move the file physically. Physical folders with lockfile (all folders) Physical folders without lockfile (only folders with uploads) Post Name/URL max. length Pro version Process failed due to an unexpected error. Queue interval Queue maximum execution time Queue pause interval Real Physical Media Redirect old media URLs Reflect the already virtually created folder structure (not the file locations) to your physical folders in %s: Reflect the folder structure of your Real Media Library in your file system. Reliable moving of files SEO URL redirects protect you from errors: If your or any other website refers to a file whose URL changes when the file is moved, the user's browser will be automatically redirected with a 301 and 302 redirect for best SEO results. Set up a delay so as not to overload your server and wait a certain time of seconds. The minimum allowed value is 1 second. Something went wrong with the handler foe the file %s. The automatic change detection is now paused. Special characters The attachment was not found or has no physical file. The handler could not be activated. The handler could not be deactivated. The minimum allowed value is 1 second. Your server configuration allows you to run the request for max. %s seconds. The name of the folder will not be visible in the URLs of the files it contains. The queue to physically move files can only be processed as long as a logged in user has the WordPress backend open in his browser. This file has no physical file - it is a virtual copy (shortcut). When the original physical file gets synchronized with the file system, this copy is automatically synchronized, too. This file is synchronized with your physical file system (<code>%s</code>). This file was already added to the queue %1$s ago and will be moved to %2$s. This limitation exists because WordPress is developed in PHP and PHP scripts must be called to be run, but cannot run as a background process. You can solve this problem by setting up a cronjob that calls the given cronjob URL regularly (e.g. every 30 seconds). This method allows you to modify the standard WordPress database table wp_posts to allow more than 255 characters as the full URL path (guid) and the length of the file name (post_name). This is an advanced option and you should create a backup before you apply the change. These changes are WordPress core update safe. Please only use them if you are aware of the technical implications of such a change and possible side effects for other WordPress plugins and themes. This option cannot be changed in the sandbox. This option is only allowed for administrators.. This service is not allowed in the sandbox. Uploads prefix We recommend a time between the two redirects of at least 48 hours to avoid conflicts. When do I need this? This is necessary, for example, if you receive the error message <strong>Could not add post to database.</strong> when uploading a new file. When processing the queue, not all requests are sent immediately, but one after the other. This value defines how long to wait between two requests. Where is your file located? WordPress default WordPress itself cannot handle special characters in file and folder names without problems. Enable this option to convert special characters to latin characters. You are not allowed to do this. You can find your cronjob service URLs in the media settings. You can automatically sort all files you have already sorted with Real Media Library in a physical way. You have not activated a handler. You have not currently activated a file handler. Please activate a file handler in the settings below. You have to ask your hoster if they offer such functionality or use an external service like easycron.com. You need to install at least version %s. Please update the software! Your new uploads will be stored in: <code>%s</code> devowl.io https://devowl.io Report-Msgid-Bugs-To: https://wordpress.org/support/plugin/src
PO-Revision-Date: 2021-10-12 08:39+0000
Last-Translator: Matthias Günter <matthias.guenter@devowl.io>
Language-Team: German <https://translate.devowl.io/projects/wordpress-real-physical-media-backend-php/develop/de/>
Language: de_DE_formal
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=2; plural=n != 1;
X-Generator: Weblate 4.8
 301 Umleitungsverzögerung (SEO) <br /><br />Bevor du alle Dateien neu sortieren lässt, verschiebe eine Datei in deiner Medienbibliothek und gehen Sie zum Dialog "Details zum Anhang" oder "Medien bearbeiten" der Datei, die du zuletzt verschoben hast. Klicke dort auf den Button "Physikalisch verschieben". Prüfe dann, ob die Datei wie erwartet unter der neuen URL verfügbar ist.<br /><br />Wir empfehlen dir diese manuelle Überprüfung durchzuführen, bevor du alle Dateien neu ordnen lässt, da spezielle WordPress-Konfigurationen in selten Fällen zu Fehlern des Media File Renamer Handler führen. <strong>Die physische Datei ist nicht mit dem oben genannten Ordner synchronisiert.</strong> Du kannst die Datei jetzt synchronisieren und von<br/>%1$s<br/>nach<br/>%2$s verschieben <strong>Der Lizenzschlüssel wurde noch nicht eingegeben</strong>. Um automatische Updates zu erhalten klicke auf “Lizenz eingeben”. Hinzufügen von %d Dateien zur Warteschlange zum Verschieben Nach dem Verschieben der letzten Datei aus einem virtuellen Ordner sollte der physische Ordner gelöscht werden, aber nur, wenn auch die Unterordner leer sind und keine Sperrdatei vorhanden ist. Nachdem die letzte Datei oder der letzte Ordner aus einem virtuellen Ordner verschoben wurde, sollten sowohl der virtuelle Ordner als auch der physische Ordner gelöscht werden. Nachdem du eine Datei physisch verschoben hast, wird eine 302-Umleitung (temporäre Umleitung) eingerichtet. Nach einer bestimmten Zeit (in Stunden) nach der letzten Aktualisierung des Speicherorts der Datei wird eine 301-Umleitung (permanente Weiterleitung) eingerichtet. Dieser zweistufige Prozess ist notwendig, um Fehlfunktionen von Caching-Plugins oder CDN-Diensten zu vermeiden. Alle Cronjob-URLs für alle Websites, die in dieser WordPress-Instanz gehostet werden: Neue Länge anwenden Automatische Umwandlung von Sonderzeichen in lateinische Zeichen Automatisches Umwandeln des gesamten Datei- und Ordnerpfades in Kleinbuchstaben Erstelle einen physischen Ordner, nachdem ein virtuellen Ordner erstellt wurde, auch wenn der Ordner noch leer ist (erstellt eine Sperrdatei %s, um den physischen Ordner zu behalten). Cronjob-Dienst Alle Sperrdateien löschen Lösche physische Ordner nach dem Löschen eines virtuellen Ordners, aber nur, wenn der physische Ordner und die Unterordner leer waren. Ordnernamen vom Dateipfad ausschließen  Handler zum Verschieben von Dateien Erster Verknüpfungspfad als Dateipfad Ordner Kostenlos Wenn die Warteschlange leer ist, muss der Browser regelmäßig überprüfen, ob sich eine neue Aufgabe in der Warteschlange befindet. Dieser Wert legt fest, nach wie viel Sekunden der Browser erneut prüft, ob ein eine neue Aufgabe vorhanden ist. Der minimal zulässige Wert beträgt 1 Sekunde. Wenn du die oben genannten Ordnereinstellungen geändert und gespeichert hast, musst du die Struktur erneut abbilden, sonst gelten die neuen Einstellungen nur für neue Ordnerstrukturen. Wenn du ein Upload-Präfix setzt, wird dieses Präfix an den obigen Pfad angehängt. Erfahre mehr über Cronjobs Erfahre mehr über Lockfiles Lockfile aktiviert  Nur Kleinbuchstaben Manuelle Änderungen werden automatisch erkannt, und es wird sofort eine Anfrage zur physischen Verschiebung der Datei gesendet. Wenn du zum Beispiel eine Datei per Drag & Drop verschiebst, wird die Datei sofort verschoben. Physikalisch verschieben Verschiebt neue Uploads direkt in den richtigen physischen Ordner, aber auch bestehende Dateien können physisch verschoben werden. Verschiebt die Datei physisch an den Ort, an dem die erste Verknüpfung erstellt wurde. Dies ist z.B. nützlich, wenn du einen Ordner "Alle Bilder" hast und die gleichen Bilder in mehreren Galerien verwendest, aber den Ordner "Alle Bilder" nicht im Pfadnamen haben möchtest. Das WP/LR-Plugin funktioniert auf diese Weise und du musst diese Option für den synchronisierten Ordner aktivieren. Das Verschieben von Dateien wird in einer Warteschlange und in mehreren Anfragen an den Server verarbeitet. Die einzelnen Anfragen müssen aufgrund der Konfiguration deines PHP Servers zeitlich begrenzt sein. Hinweis: Du hast die automatische Änderungserkennung aktiviert. Wenn du den Präfix änderst, werden alle Dateien verschoben, was einige Minuten dauern kann. Hinweis: Du hast die automatische Änderungserkennung aktiviert. Wenn du diese Option änderst, werden alle Dateien verschoben, was einige Minuten dauern kann. Gilt nur, wenn die automatische Änderungserkennung von Real Physical Media aktiviert ist. Wenn du eine einzelne Mediendatei öffnest, kannst du den physischen Speicherort sehen und die Datei manuell physisch verschieben. Physische Ordner mit Lockfile (alle Ordner) Physische Ordner ohne Lockfile (nur Ordner mit Uploads) Beitragsname/URL max. Länge Pro-Version Prozess aufgrund eines unerwarteten Fehlers fehlgeschlagen. Warteschlangen-Intervall Maximale Ausführungszeit der Warteschlange Warteschlangen-Pausenintervall Real Physical Media Umleitung alter Medien-URLs Spiegele die bereits virtuell erstellte Ordnerstruktur (nicht die Struktur der Dateien) in physischen Ordner in %s wider: Spiegle die Ordnerstruktur von Real Media Library in deinem Dateisystem wider. Zuverlässiges Verschieben von Dateien URL-Umleitungen schützen dich vor Fehlern: Wenn du oder eine andere Website auf eine Datei verweist, deren URL sich ändert, da du sie verschoben hast, wird der Browser des Benutzers automatisch mit einer 301- und 302-Umleitung für beste SEO-Ergebnisse umgeleitet. Richten eine Verzögerung ein, um deinen Server nicht zu überlasten. Der minimal zulässige Wert beträgt 1 Sekunde. Etwas ist mit dem Handler der Datei %s schief gelaufen. Die automatische Änderungserkennung wird nun ausgesetzt. Keine Sonderzeichen Der Anhang wurde nicht gefunden oder hat keine physische Datei. Der Handler konnte nicht aktiviert werden. Der Handler konnte nicht deaktiviert werden. Der minimal zulässige Wert beträgt 1 Sekunde. Deine Serverkonfiguration erlaubt es dir die Anfrage für max. %s Sekunden laufen zu lassen. Der Name des Ordners ist in den URLs der darin enthaltenen Dateien nicht sichtbar. Die Warteschlange zum physischen Verschieben von Dateien kann nur so lange bearbeitet werden, wie ein eingeloggter Benutzer das WordPress-Backend in seinem Browser geöffnet hat. Diese Datei hat keine physische Datei - sie ist eine virtuelle Kopie (Verknüpfung). Wenn die ursprüngliche physische Datei mit dem Dateisystem synchronisiert wird, wird auch diese Kopie automatisch synchronisiert. Diese Datei ist mit deinem physischen Dateisystem synchronisiert (<code>%s</code>). Diese Datei wurde bereits vor %1$s zur Warteschlange hinzugefügt und wird nach %2$s verschoben. Diese Einschränkung besteht, weil WordPress in PHP entwickelt wurde und PHP-Skripte zur Ausführung aufgerufen werden müssen, aber nicht als Hintergrundprozess laufen können. Du kannst dieses Problem lösen, indem du einen Cronjob einrichtest, der die angegebene Cronjob-URL regelmäßig (z.B. alle 30 Sekunden) aufruft. Diese Option erlaubt es dir die Standard WordPress Datenbanktabelle wp_posts so zu modifizieren, dass mehr als 255 Zeichen als vollständiger URL-Pfad (guid) und die Länge des Dateinamens (post_name) erlaubt sind. Dies ist eine Option für fortgeschrittene Administratoren und solltest ein Backup erstellen, bevor du die Änderung anwendest. Diese Änderungen bleiben auch bei einem Update von WordPress bestehen. Bitte verwende diese Option nur, wenn dir die technischen Implikationen einer solchen Änderung und möglicher Nebenwirkungen für andere WordPress-Plugins und -Themes bewusst sind. Diese Option kann in der Sandbox nicht geändert werden. Diese Option ist nur für Administratoren veränderbar. Diese Service ist in der Sandbox nicht erlaubt. Uploads-Präfix Wir empfehlen eine Zeitspanne von mindestens 48 Stunden zwischen den beiden Umleitungen, um Konflikte zu vermeiden. Wann brauche ich das? Dies ist z.B. notwendig, wenn du beim Hochladen einer neuen Datei die Fehlermeldung “<strong>Datei konnte der Datenbank nicht hinzugefügt werden.</strong>” erhältst. Bei der Abarbeitung der Warteschlange werden nicht alle Anfragen sofort, sondern eine nach der anderen gesendet. Dieser Wert definiert, wie lange zwischen zwei Anfragen gewartet werden soll. Wo sind die Dateien gespeichert? WordPress Standard WordPress selbst kann Sonderzeichen in Datei- und Ordnernamen nicht ohne Probleme verarbeiten. Aktivieren diese Option, um Sonderzeichen in lateinische Zeichen umzuwandeln. Du darfst dies nicht tun. Deine Cronjob-Service-URLs findest du in den Medieneinstellungen. Du kannst alle Dateien, die du bereits mit Real Media Library sortiert hast, nachträglich automatisch physisch sortieren lassen. Sie haben keinen Handler aktiviert. Du hast derzeit keinen Datei-Handler aktiviert. Bitte aktiviere einen Datei-Handler in den untenstehenden Einstellungen. Du musst deinen Webhoster fragen, ob er eine solche Funktionalität anbietet oder einen externen Dienst wie easycron.com nutzt. Du musst mindestens Version %s installieren. Bitte aktualisiere die Software! Deine neuen Uploads werden gespeichert in: <code>%s</code> devowl.io https://devowl.io/de/ 