<?php

/* 
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: b99b0a84dd940e6d15f82996ca83cd2706474961 $
 * $Date$
 */

return [
    'SERVER'                                => 'Server',
    'SERVER_ACTION'                         => 'Aktion',
    'SERVER_EDIT'                           => 'Bearbeiten',
    'SERVER_SAVE'                           => 'Speichern',
    'SERVER_SUB_LIST'                       => 'Server verwalten',
    'SERVER_SUB_CREATE'                     => 'Server anlegen',
    'SERVER_CREATE_INFO'                    => 'In diesem Schritt können neue dedizierte Server hinzugefügt werden. Die hier erwarteten Zugangsdaten sind die ServerQuery-Daten.',
    'SERVER_CREATE_SUCCESS'                 => 'Der Server wurde erfolgreich angelegt.',
    'SERVER_CREATE_FAILED'                  => 'Beim Anlegen des Servers ist ein Fehler aufgetreten, bitte prüfen Sie Ihre Eingaben.',
    'SERVER_FORM_USERNAME'                  => 'ServerQuery-User',
    'SERVER_FORM_PASSWORD'                  => 'Passwort',
    'SERVER_FORM_HOSTNAME'                  => 'IP-Adresse/Hostname',
    'SERVER_FORM_PORT'                      => 'Query-Port',
    'SERVER_FORM_SAVE'                      => 'Speichern',
    'SERVER_NO_RECORD'                      => 'Keine Einträge verfügbar',
    
    //Virtual Servers
    'SERVER_VIRTUAL'                        => 'Virtuelle Server',
    'SERVER_VIRTUAL_NAME'                   => 'Name',
    'SERVER_VIRTUAL_PORT'                   => 'Port',
    'SERVER_VIRTUAL_STATUS'                 => 'Online-Status',
    'SERVER_VIRTUAL_SLOTS'                  => 'Belegte Slots',
    'SERVER_VIRTUAL_VERSION'                => 'Server-Version',
    'SERVER_VIRTUAL_MANAGE'                 => 'Verwalten',
    'SERVER_VIRTUAL_MANAGEMENT'             => 'Verwaltungszentrum',
    'SERVER_VIRTUAL_CHANNEL'                => 'Channelliste',
    'SERVER_VIRTUAL_COMPLAIN_AUOTBAN_COUNT' => 'Autoban Beschwerdeanzahl',
    'SERVER_VIRTUAL_COMPLAIN_AUOTBAN_TIME'  => 'Autoban Dauer',
    'SERVER_VIRTUAL_COMPLAIN_REMOVE_TIME'   => 'Entfernen nach',
    'SERVER_VIRTUAL_COMPLAIN_AUTOBAN_TIME'  => 'Autoban-Dauer',
    'SERVER_VIRTUAL_COMPLAIN_REMOVE_TIME'   => 'Autoban entfernen nach',
    'SERVER_VIRTUAL_BANDWIDTH_TOTAL_UPLOAD'     => 'Maximale Uploadbandbreite',
    'SERVER_VIRTUAL_BANDWIDTH_TOTAL_DOWNLOAD'   => 'Maximale Downloadbrandbreite',
    'SERVER_VIRTUAL_WEBLIST'                => 'Report an Server List',
    
    'SERVER_VIRTUAL_HOST'                   => 'Host',
    'SERVER_VIRTUAL_BANDWIDTH'              => 'Bandbreite',
    'SERVER_VIRTUAL_BANDWIDTH_INFO'         => 'Die maximale Bandbreite begrenzt die Geschwindigkeit mit der Daten heruntergeladen werden können. Die maximale Bandbreite von -1 steht für unbeschränkt.',
    'SERVER_VIRTUAL_LOG'                    => 'Protokoll',
    
    'SERVER_VIRTUAL_UPDATE_SUCCESS'         => 'Die Server-Konfiguration wurde erfolgreich gespeichert.',
    
    'SERVER_VIRTUAL_ANTIFLOOD'              => 'Anti-Flood',
    'SERVER_VIRTUAL_ANTIFLOOD_POINTS_TICK_REDUCE'               => 'Reduziere Punkte pro Tick',
    'SERVER_VIRTUAL_ANTIFLOOD_POINTS_NEEDED_COMMAND_BLOCK'      => 'Punkte, um Befehle zu blockieren',
    'SERVER_VIRTUAL_ANTIFLOOD_POINTS_NEEDED_IP_BLOCK'           => 'Punkte, um IP zu sperren',
    'SERVER_VIRTUAL_SECURITY'               => 'Sicherheit',
    'SERVER_VIRTUAL_MISC'                   => 'Verschiedenes',
    'SERVER_VIRTUAL_LOG_CLIENTS'            => 'Protokollierung für Clients aktivieren',
    'SERVER_VIRTUAL_LOG_QUERY'              => 'Protokollierung für ServerQuery aktivieren',
    'SERVER_VIRTUAL_LOG_CHANNEL'            => 'Protokollierung für Channels aktivieren',
    'SERVER_VIRTUAL_LOG_PERMISSIONS'        => 'Protokollierung für Rechte aktivieren',
    'SERVER_VIRTUAL_LOG_SERVER'             => 'Protokollierung für Server aktivieren',
    'SERVER_VIRTUAL_LOG_FILETRANSFER'       => 'Protokollierung für Dateitransfer aktivieren',
    'SERVER_VIRTUAL_SECURITY_LEVEL'         => 'Benötigte Sicherheitsstufe',
    'SERVER_VIRTUAL_SECURITY_LEVEL_INFO'    => 'Auf einem TS3 Server kann eingestellt werden, welche Rechte bestimmte Sicherheitsstufen haben bzw. welche Richtlinien für eine Sicherheitsstufe gelten. Es kann z.B. eingestellt werden, dass nur Identitäten mit einer Sicherheitsstufe von 22 auf den Server joinen können. Hauptsächlich soll dies Spamm und Hacker vom Server halten, da diese nach einem Bann eine neue Identität erstellen mit dementsprechend hoher Sicherheitsstufe erstellen müssten. Jede Erhöhung kann die Zeit zur Generation der höheren Sicherheitsstufe erheblich erhöhen.',
    'SERVER_VIRTUAL_AUTOSTART'              => 'Autostart aktivieren',
    'SERVER_VIRTUAL_STANDARD_GROUP'         => 'Standard Gruppen',
    'SERVER_VIRTUAL_DEFAULT_GROUP'          => 'Server Gruppe',
    'SERVER_VIRTUAL_DEFAULT_CHANNEL_GROUP'  => 'Channel Gruppe',
    'SERVER_VIRTUAL_DEFAULT_CHANNEL_ADMIN_GROUP'    => 'Channel Admin Gruppe',
    'SERVER_VIRTUAL_COMPLAINS'              => 'Beschwerden',
    'SERVER_VIRTUAL_MIN_CLIENTS_BEFORE_SILENCE'         => 'Min Clients im Channel für Stille',
    'SERVER_VIRTUAL_PRIORITY_SPEAKER_DIMM_MODIFICATOR'  => 'Abschwächung des Gesprächleiters',
    'SERVER_VIRTUAL_CHANNEL_TEMP_DELETE_DELAY'          => 'Verzögerung des Löschens temporärer Channel',
    'SERVER_VIRTUAL_ENCMODE_GLOBAL_ON'                  => 'Global an',
    'SERVER_VIRTUAL_ENCMODE_GLOBAL_OFF'                 => 'Global aus',
    'SERVER_VIRTUAL_ENCMODE_INDIVIDUAL'                 => 'Channel individuell einstellen',
    'SERVER_VIRTUAL_ENCMODE'                            => 'Channel Voice Verschlüsselung',
    
    
    //Channel
    'SERVER_VIRTUAL_CHANNEL_NAME'           => 'Channel-Name',
    'SERVER_VIRTUAL_CHANNEL_DESCRIPTION'    => 'Beschreibung',
    'SERVER_VIRTUAL_CHANNEL_EDIT'           => 'Channel editieren',
    'SERVER_VIRTUAL_CHANNEL_DELETE'         => 'Channel löschen',
    'SERVER_VIRTUAL_SUB_CHANNEL'            => 'Sub-Channel',
    'SERVER_VIRTUAL_WELCOME_MESSAGE'        => 'Willkommensnachricht',
    'SERVER_VIRTUAL_MAX_CLIENTS'            => 'Max. Clientanzahl',
    'SERVER_VIRTUAL_PASSWORD'               => 'Kennwort',
    'SERVER_VIRTUAL_PING'                   => 'Ping',
    'SERVER_VIRTUAL_EDIT'                   => 'Virtuellen Server editieren',
    
    //Groups
    'SERVER_VIRTUAL_GROUP_NAME'             => 'Gruppe',
   
    
    //Exceptions
    'Operation timed out'                   => 'Der Server hat nicht in der vorgebenen Zeit geantwortet. Operation fehlgeschlagen.',
    'invalid URI supplied'                  => 'Der angegebene Server oder die Zugangsdaten sind ungültig.',
];


