# admin-panel

### How to run project
After copying the repository, run follow command
```
make start
```
The default project address is http://localhost:8080/

### How to log in
In order to successfully authorize you need to use data from `app/src/DataFixtures/admin.txt`
When you go to the page with the message about successful authorization, repeat the request to the router http://localhost:8080/

### About CRUD operations
After adding a book or author, you will see a message indicating whether the operation was successful
To see the `/books` page or the `/authors` page, repeat the request to the corresponding routers

### Warning
The delete operation is not displayed in the interface, but you can delete an element by sending a DELETE request to `http://localhost:8080/books/id` or `http://localhost:8080/authors/id`, where `id` is the id of an element existing in the database

### Feedback
You can fill out the following form https://forms.gle/CXQkH1UGtCMhuKNc8
