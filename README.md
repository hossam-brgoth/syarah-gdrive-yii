# syarah-gdrive-yii
A small yii project listing Google Drive files via Oauth authentication

- All code in the following files:
```/Controllers/SiteController```
```/views/site/index.php```
```/views/site/files.php```
- Library used:
```google/apiclient:^2.10```
- Brief: actionIndex triggered via index.php to show the Google button for Oauth, the user clicks the button, the result will redirect to files.php through actionFiles to grab code then token, to be passed to the get_gdrive_files function that calls google files list API and returns the final result.
- Please run ```composer install``` then run app using ```php yii serve --port 8888```
