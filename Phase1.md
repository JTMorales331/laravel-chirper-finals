qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq<img width="150px" src="https://w0244079.github.io/nscc/nscc-jpeg.jpg" >

## INET 2005 - Final Assignment - Phase 1

### Chirper Application: Getting Started with Laravel

### **Overview**
This phase requires you to complete the official Laravel "Getting Started with Laravel" video series, which guides you through building a small Twitter-like application called **Chirper**.

- Video Series: [Getting Started with Laravel](https://laravel.com/learn/getting-started-with-laravel)
- You must follow the series and build the Chirper application as demonstrated.
- Completion of this phase is required before moving on to Phase 2.

---

### **Video Series Outline & Expectations**


Below is a breakdown of each video in the series. For each, follow the instructions and ensure your application meets the expectations:

1. **What are we building?**
   - Overview: Introduction to the Chirper project. Understand the goals and features of the Twitter-like application you will build.
   - Expected: You should be able to describe the core features and purpose of Chirper.

2. **Setting up your Laravel project**
   - Overview: Learn how to install Laravel, set up your development environment, and initialize your project.
   - Expected: We will set up our project (slightly differently) as an in-class project. Be sure to follow along with the steps that we do in class. Your URL for the project will be different than the URL shown in the videos. (Because we're using Laravel Herd folder). Be sure you can access your new Laravel project at the URL (http://final-assignment-[your_github_username].test). Consult with your instructor if you are having difficulties with this. As this will be an in-class activity, it will be recorded. Reference the recording if needed.

YOUR INDIVIDUAL WORK FOR THIS PHASE WILL BEGIN WITH VIDEO 3. AT THIS POINT, YOUR PROJECT SHOULD BE CREATED IN THE PROVIDED GITHUB CLASSROOM REPOSITORY FOLDER. CREATION OF THE LARAVEL PROJECT BY ANY OTHER MEANS OR IN ANY OTHER FOLDER OTHER THAN THE GITHUB CLASSROOM REPO FOLDER WILL NOT BE ACCEPTED BY YOUR INSTRUCTOR.

3. **Your first route**
   - Overview: Create your first route in Laravel and understand basic routing concepts.
   - Expected: Complete any coding tasks in the video. Be able to define and test a simple route in your application.
   - **Be sure to** access your app at `http://final-assignment-[your_github_username].test`.  
   - **Be sure to** create Blade view files for new pages in `resources/views` and map them via `routes/web.php`.  
   - **Be sure to** use layout components (`<x-layout>` and `{{ $slot }}`) for reusable page structure.  
   - **Be sure to** make titles and content dynamic with variables like `$title`.  
   - **Be sure to** leverage built-in Tailwind CSS and DaisyUI for consistent styling and animations.
   - Commit: Be sure to commit and push your changes and additions with the message 'Video 3 complete' before continuing

4. **Deploying your app (Watch but do not do)**
   - You can watch this video but you do not need to follow the steps. This deployment method uses Laravel Cloud. In order to use Laravel Cloud, you must provide a Credit Card which is not feasible with our class scenario. Instead, we will deploy our app a different way towards the end of the Assignment. We will work from our local dev environment for this phase.

5. **What is MVC?**
   - Overview: Introduction to the Model-View-Controller architecture and how Laravel implements MVC.
   - Expected: Complete any coding tasks in the video. Be able to explain MVC and identify models, views, and controllers in your project.
   - **Be sure to** understand the MVC structure: Models manage data, Views display information, and Controllers handle requests and coordinate responses.  
   - **Be sure to** move logic from your routes file into controllers for cleaner, more organized code.  
   - **Be sure to** create controllers using `php artisan make:controller` and choose resource controllers when appropriate.  
   - **Be sure to** pass data from controllers to Blade views using arrays and iterate over them with Blade templating.  
   - **Be sure to** leverage the seven standard resource methods (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`) for common application actions.
   - Commit: Be sure to commit and push your changes and additions with the message 'Video 5 complete' before continuing

6. **Working with the database**
   - Overview: Configure your database, run migrations, and connect Laravel to your database.
   - Expected: Complete any coding tasks in the video. Have a working database connection and run initial migrations.
   - **Be sure to** use a database (like SQLite for local development) to store data permanently instead of hard-coded values.  
   - **Be sure to** create migrations with `php artisan make:migration` to define your database schema and columns.  
   - **Be sure to** run migrations using `php artisan migrate` and manage them with `migrate:fresh` or `migrate:rollback` when needed.  
   - **Be sure to** use foreign keys and constraints (e.g., `foreignId`, `constrained`, `cascadeOnDelete`) to maintain relationships between tables.  
   - **Be sure to** interact with your database using Laravel tools like Tinker, the DB facade, or GUI tools before building your UI.  
   - Commit: Be sure to commit and push your changes and additions with the message 'Video 6 complete' before continuing

7. **Our first model**
   - Overview: Create your first Eloquent model and understand how models interact with the database.
   - Expected: Complete any coding tasks in the video. Create a model (e.g., Chirp) and use it to interact with the database.
   - **Be sure to** use models to interact with your database instead of writing raw SQL; models provide a clean, eloquent interface.  
   - **Be sure to** define the `fillable` array in your model to specify which fields can be mass assigned.  
   - **Be sure to** create relationships between models (e.g., `belongsTo` and `hasMany`) to represent associations like users and chirps.  
   - **Be sure to** use Eloquent to easily retrieve related data, such as `$chirp->user` or `$user->chirps`.  
   - **Be sure to** leverage Eloquent methods like `all()`, `latest()`, or `take()` for querying data efficiently.  
   - **Be sure to** update your controller to fetch real data from models and eager load relationships to prevent N+1 query issues.  
   - **Be sure to** adjust your views to handle model data instead of arrays, using `@forelse` or similar Blade directives for collections.  
   - **Be sure to** use helpers like `diffForHumans()` for readable timestamps.  
   - **Be sure to** test your data creation and relationships in Tinker before integrating into the UI.  
   - Commit: Be sure to commit and push your changes and additions with the message 'Video 7 complete' before continuing

8. **Showing the feed**
   - Overview: Display a list of chirps (messages) in your application using Blade templates and controllers.
   - Expected: Complete any coding tasks in the video. Render a feed of chirps for users to view.
   - **Be sure to** create a reusable Blade component for individual chirps to simplify updates and styling.  
   - **Be sure to** use props in your component to pass in chirp data (e.g., user info, message, timestamps).   
   - **Be sure to** display user avatars using services like Laravel Cloud, with a default for anonymous users.  
   - **Be sure to** loop through chirps in your home view by using the new component for consistency.  
   - **Be sure to** use seeders (PHP Artisan DB:Seed) to quickly populate your database with sample chirps.  
   - **Be sure to** adjust CSS for spacing and formatting to ensure clean display of chirps.  
   - **Be sure to** maintain a clean and reusable structure for user info, timestamps, and messages.  
   - **Be sure to** prepare the app for adding functionality like creating new chirps next.
   - Commit: Be sure to commit and push your changes and additions with the message 'Video 8 complete' before continuing

9. **Creating and storing Chirps**
   - Overview: Implement functionality to create and save new chirps to the database.
   - Expected: Complete any coding tasks in the video. Users can post new chirps and see them appear in the feed.
   - **Be sure to** create a form in your Blade view to allow users to submit data (e.g., new chirps).  
   - **Be sure to** handle form submissions in your controller using a `store` method.  
   - **Be sure to** validate input on the server side (e.g., required, max/min length).  
   - **Be sure to** save validated data to the database using your model.  
   - **Be sure to** redirect back after storing data, optionally flashing a success message.  
   - **Be sure to** define a POST route pointing to your controller’s store method.  
   - **Be sure to** include CSRF protection in your form.  
   - **Be sure to** handle validation errors in your view and display old input values.  
   - **Be sure to** customize validation messages for better user experience.  
   - **Be sure to** display success messages via session flash data or a toast notification.  
   - **Be sure to** consider future improvements, like rate-limiting submissions or real-time updates.  
   - Commit: Be sure to commit and push your changes and additions with the message 'Video 9 complete' before continuing

10. **Edit and delete Chirps**
   - Overview: Add features to edit and delete chirps, including form handling and validation.
   - Expected: Complete any coding tasks in the video. Users can update or remove their own chirps.
   - **Be sure to** add edit and delete buttons to each chirp in your Blade view.  
   - **Be sure to** create routes for `edit`, `update`, and `destroy`, using route model binding.  
   - **Be sure to** create an `edit` view pre-filled with the chirp message.  
   - **Be sure to** validate input when updating or creating chirps.  
   - **Be sure to** return redirects with success messages after updates or deletions.  
   - **Be sure to** use a confirmation modal for deletions.  
   - **Be sure to** implement authorization so users can only modify their own chirps.  
   - **Be sure to** optionally indicate when a chirp has been edited.  
   - **Be sure to** plan for authentication to secure all actions.
   - Commit: Be sure to commit and push your changes and additions with the message 'Video 10 complete' before continuing

11. **Basic authentication: Registration**
   - Overview: Implement user registration using Laravel's authentication scaffolding.
   - Expected: Complete any coding tasks in the video. Users can register for an account in your application.
   - **Be sure to** create a **register page** (Blade view) with `name`, `email`, `password`, and `password_confirmation`.  
   - **Be sure to** validate inputs and hash passwords in a **Register Invocable Controller** that logs in the user and redirects home.  
   - **Be sure to** add `GET /register` (view) and `POST /register` (controller) routes with `guest` middleware and use named routes.  
   - **Be sure to** show **Sign In / Sign Up** only for guests (`@guest`) and user info + **Logout** for authenticated users (`@auth`).  
   - **Be sure to** create a **Logout Invocable Controller** that logs out the user and redirects home.  
   - **Be sure to** add `POST /logout` route with `auth` middleware.  
   - **Be sure to** group authenticated routes with `auth` middleware to restrict chirp creation/editing/deleting.  
   - **Be sure to** create chirps under the logged-in user (`auth()->user()->chirps()->create(...)`).  
   - **Be sure to** use policies and Blade `@can` directive for conditional edit/delete buttons.  
   - Commit: Be sure to commit and push your changes and additions with the message 'Video 11 complete' before continuing

12. **Basic authentication: Login/Logout**
   - Overview: Implement login and logout functionality for users.
   - Expected: Complete any coding tasks in the video. Users can securely log in and out of the Chirper app.
   - **Be sure to** create a **login Blade view** similar to the register page with `email`, `password`, and optional `remember` checkbox.  
   - **Be sure to** create a **Login Invocable Controller** using the `auth` facade to `attempt` login and regenerate the session on success, returning back with errors on failure.  
   - **Be sure to** invalidate and regenerate the session token in the **Logout controller** for security.  
   - **Be sure to** add `GET /login` (view) and `POST /login` (controller) routes with `guest` middleware and name the route for easy referencing.  
   - **Be sure to** test login/logout flows:  
     - Only authenticated users can create, edit, or delete chirps.  
     - Users can only modify their own chirps (using policies and `@can` Blade directive).  
     - Guest users are redirected to login when attempting restricted actions.  
   - **Be sure to** commit and push regularly to Laravel Cloud for automatic deployment.  
   - **Be sure to** verify your application in production: users, authentication, avatars, and full CRUD functionality should all work seamlessly.  
   - Commit: Be sure to commit and push your changes and additions with the message 'Video 3 complete' before continuing

13. **What's Next?**
   - Overview: Review what you've built and explore next steps for enhancing your application.
   - Expected: Be ready to proceed to Phase 2.

---

### **Requirements**

1. **Complete the Video Series**
   - Watch and follow all videos in the [Getting Started with Laravel](https://laravel.com/learn/getting-started-with-laravel) series.
   - Build the Chirper application step-by-step as shown in the videos. (With outlined changes and/or modifications)

2. **Application Features**
   - Your Chirper app should allow users to:
     - Register and log in
     - Post short messages (chirps)
     - View a feed of chirps
     - Edit and delete their own chirps
   - Ensure your application matches the functionality demonstrated in the video series.

3. **Code Quality**
   - Follow best practices as shown in the videos.
   - Use version control (Git) to track your progress by commiting and pushing changes after each video as instructed above.

---

### **Sign-Off and Submission**
- You must demonstrate your completed Chirper application to your instructor for sign-off.
- Be prepared to answer questions about your implementation.
- Commit and push your code to your final assignment repository.

---

## **Next Steps**
- Once Phase 1 is complete and signed off, proceed to Phase 2 to enhance your Chirper application.
