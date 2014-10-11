#!/usr/bin/python
import mechanize

br = mechanize.Browser()
br.set_handle_robots(False)
br.set_handle_refresh(False)
br.set_handle_equiv(False)
br.headers = [('User-agent', 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.1) Gecko/2008071615 Fedora/3.0.1-1.fc9 Firefox/3.0.1')]  

r = br.open("http://myanimelist.net/anime/16742/Watashi_ga_Motenai_no_wa_Dou_Kangaetemo_Omaera_ga_Warui!").read()

tofile = open("stranica", "w")
tofile.write(r)
tofile.close()

print r
