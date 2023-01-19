# PersonalBlog-PHP-Takuya-WhatIUse
Website completely based on Takuya Matsuyama's WhatIUse web! I tried to replicate the web Takuya's did because I really like how it look almost in every aspect and because I have not seen a similar web like this one before. In this case, I've made it completely in Php, with a backend included!![yu8r9KS_6-uQSlCtscH-Nu3duNChr-1](https://user-images.githubusercontent.com/105828786/201494860-9886862a-561f-4a3a-97d6-426104756736.png)

# Frontend
This is my firs time building a web that supports dark mode, and in my opinion the transitions between dark and light mode, is one of my favourite things (This is one of the reasons i loved the original one)
* * *
![j_BCwugvR-MMxIJsRaw-opMerlwBw-darklight](https://user-images.githubusercontent.com/105828786/201495026-037ba440-a51c-4746-9bcd-cbcca07ef417.png)
* * *
![9_p0RQHeo-AVCx_-URf-XPo1dFLaK-categories](https://user-images.githubusercontent.com/105828786/201495048-c08a7604-764d-4f48-b75f-4b99021ad15f.png)

# Inside the cards 
It'll be 2 photos with some information in between of them, making it minimaist and at the same time very clean.
![oM2IJRUE0-lGNcaBg3k-Q29cfAJZh-clipboard](https://user-images.githubusercontent.com/105828786/201495062-b2c82f6c-9867-4ba6-a00f-521b6807fddc.png)
I've code that using just 1 php file, you can see every cards information displayed in the same way. This make everything better in certain way, because this makes that you dont have to create 1 file per card and full the project folders with php files for the same thing.

# About me
For the final section of the frontend, i've added something new that the original web didn't have, because i thought it would make the web look more like a personal blog!
* * *
![iwyf7KRSi-OEfPMter4-clipboard](https://user-images.githubusercontent.com/105828786/201495072-c89d75c4-5d74-484a-aaae-772a45ca1b93.png)
This is the section where you can see more personal information about the person, at the same time as you can see for example projects of the person displayed in cards! All this information is editable in the backend, where you can edit from the profile picture, to the location!

# Backend
Here only the admin has acces to, due a login system added!![ep1OagbeU-Txv2dO-XR-clipboard](https://user-images.githubusercontent.com/105828786/201495080-b4c67f11-fe09-432b-ac16-9ac78f314e9f.png)
![yu8r9KS_6-uQSlCtscH-Nu3duNChr-1](https://user-images.githubusercontent.com/105828786/201495086-6b66a0ad-249a-4dc7-8715-176d9ca851ec.png)
Once the admin is logged in, it'll find a copy of the landing page of the frontend, but everything here is to make sure it did upload, edit or delete the data correctly! So the cards dont actually are linked to nothing. 

# Cards section!
![V7sFmbcww-durZZOZOZ-clipboard](https://user-images.githubusercontent.com/105828786/201495102-d25134aa-55a5-4102-99e4-6b76b4ed909a.png)
Here it'll displayed a table with every card and it's content. Every card is made with 3 images, the first one being the thumbail of every card, and the 2 others being the ones displayed inside of every card. Keep in mind this order because this order is the one used for the forms of Adding data and Editing data.
Just as i said, in this section you'll be able to:
* Add data
* Search based on what you're looking for
* Edit data
* Delete dete

All the images that are uploaded into the web, are saved locally in a folder called "files/images/"
![330xSg-nL-bah_asngd-clipboard](https://user-images.githubusercontent.com/105828786/201495127-9b00d4c5-5a4a-4787-acd4-6316f74f33b2.png)
* * *
To make sure the folder dont have infinite images everytime someone edit data, i made that it'll automatically delete the last images being used from the folder and the pc, and it will upload the new ones being edited. Same will happen when deleting data from the table.
![Yr95NLtyR-V3xX_bOmi-code](https://user-images.githubusercontent.com/105828786/201495136-8a65ab78-c5b3-4d3d-836c-4c2e0bf02a12.png)
