# Web Project : LeoCrush

## Team info :
* Thomas Rodrigues
* Clément Roure
* Nathan Hervier
* Jacky Christine La Reine Ekoua
* Léo Trotin

## Intro
The goal of this project is to create light social network like Twitter or Mastodon for micro blogging :
* client website to display users profiles, users time line and post short texts
* server to manage accounts and content
* ActivityPub API to manage multi servers of the same project and connect to the Fediverse

Our site must have these characteristics:

### Minimal features
* User / Password
* SignUp
* SignIn
* LogOut
* Post Messages
* Post answers to a message
* Post Images (optionnal)
* Direct Messages (optionnal)
* Follow / Unfollow a User
* Profile Page
* Timeline (view following messages)
* Likes / Unlike (Optionnal)

Public site :
Homepage (no member connected => subscribe / login))
Home for a connected user => time line
Profile page for a user (connected user, its followers/followings or anybody else on the same instance/software/from the fediverse)
User search page or form to display the profile of a user (username@domainname)
Subscribe page + OK + email OK + email checked
—
Server programs :
Inbox dispatcher (get message from outside and put it in user timeline)
Outbox dispatcher (post local messages to other users (locally or on the network))
Programs to answer to website (login / logout / subscribe / follow / unfollow / post message / post direct message / ...)

### Additional features :
Our social network will be usable by the students of our university.
In addition to the social networking feature, we're also going to make sure users can use it as a dating site for college students who are over 18.

### Frameworks :
* React
* Tailwind css or CSS

### Languages :
* Typescript
* php

### BackEnd :
* node.js
