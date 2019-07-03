CMS sandsized

Replace following when "install" on new page: 

REPLACE_ME_PATH -> if install in root folder delete this  
ReplaceDB -> this is the prefix for databasenames  
  
Make new Repo and add this an upstream:   
  
git remote add upstream https://github.com/Rhodez-x/sandsized-CMS.git  

When the upsteam is set, get the core by typing:  
git pull upstream master  
  
And upload it to the currrent repo  
git push origin master  
  
When you have to update the core use these comands:   
git fetch upstream  
git merge upstream/master  
git push origin master  
  
Global Information 

