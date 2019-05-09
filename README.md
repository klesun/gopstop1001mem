# gopstop1001mem
Interface to 1001mem.ru content with nice filters

The aim of this project was to crawl and filter out stupid posts from https://1001mem.ru and https://memebase.cheezburger.com/ and show you only best of the best of the best of them. 

If I'm not mistaken there was also a button to rate them yourself. I remember scrolling through this stuff in a train a lot, oh these good old times of youth...

The graph below shows the id on X axis and the amount of upvotes on the Y axis. After reading most of the posts, I'd like to note the sad fact that the further timeline goes, the lower drops the average quality of the content, as you can guess from the shape of the graph. 

![](https://raw.githubusercontent.com/klesun/gopstop1001mem/master/images/graph1001mem_1000X480.jpeg)

The database with upvotes and id-s:

https://github.com/klesun/gopstop1001mem/blob/master/DATA/mysqldump1001mem.sql

https://github.com/klesun/gopstop1001mem/blob/master/DATA/mysqldumpMemebase.sql

The scripts that crawled them:

https://github.com/klesun/gopstop1001mem/tree/master/DATA/retrieveData
