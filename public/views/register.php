<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="h-full">
    <div class="mx-auto">
        <div class="flex justify-center px-6 py-6">
            <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                <div class="w-full h-auto hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
                     style="background-image: url('https://images.unsplash.com/photo-1735406818183-a1162c38e6e2?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                </div>
                <div class="w-full lg:w-7/12 bg-white p-5 sm:rounded-3xl rounded-lg lg:rounded-l-none shadow-lg">
                    <h3 class="py-4 text-2xl text-center text-gray-800">Create an Account!</h3>
                    <form id="registerForm" method="post" action="index.php?action=register" class="px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                                    First Name
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border-b-2 border-gray-300 focus:outline-none focus:border-cyan-500"
                                    id="firstName" type="text" name="prenom" placeholder="First Name"/>
                                <div id="errorFirstName" class="text-red-500 text-xs mt-1"></div>
                            </div>
                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="lastName">
                                    Last Name
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border-b-2 border-gray-300 focus:outline-none focus:border-cyan-500"
                                    id="lastName" type="text" name="nom" placeholder="Last Name"/>
                                <div id="errorLastName"  class="text-red-500 text-xs mt-1"></div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                Email
                            </label>
                            <input
                                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border-b-2 border-gray-300 focus:outline-none focus:border-cyan-500"
                                id="email" type="email" name="email" placeholder="Email"/>
                            <div id="errorEmail" class="text-red-500 text-xs mt-1"></div>
                        </div>
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                    Password
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border-b-2 border-gray-300 focus:outline-none focus:border-cyan-500"
                                    id="password" name="password" type="password" placeholder="******************"/>
                                <div id="errorPassword" class="text-red-500 text-xs mt-1"></div>
                            </div>
                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="c_password">
                                    Confirm Password
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border-b-2 border-gray-300 focus:outline-none focus:border-cyan-500"
                                    id="c_password" type="password" placeholder="******************"/>
                                <div id="errorCPassword" class="text-red-500 text-xs mt-1"></div>
                            </div>
                        </div>
                        <div class="mb-4">
    <label class="block mb-2 text-sm font-bold text-gray-700" for="profilePicture">
        Profile Picture
    </label>
    <input
        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border-b-2 border-gray-300 focus:outline-none focus:border-cyan-500"
        id="profilePicture" type="file" accept="image/*" />
    <div id="errorProfilePicture" class="text-red-500 text-xs mt-1"></div>
</div>

                        <div class="relative">
                <select id="countries" name="role" class="bg-gray-50 border border-gray-300 my-3 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mx-auto p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose yor Role</option>
                    <option value="auteur">Auteur</option>
                    <option value="visiteur">Visiteur</option>
                </select>
                </div>
                        <div class="mb-6 text-center">
                            <button
                                class="w-full px-4 py-2 font-bold text-white bg-cyan-500 rounded-full hover:bg-cyan-600 focus:outline-none focus:shadow-outline"
                                type="submit">
                                Register Account
                            </button>
                        </div>
                        <hr class="mb-6 border-t"/>
                        <div class="text-center">
                            <a class="inline-block text-sm text-cyan-500 hover:text-cyan-700" href="#">
                                Forgot Password?
                            </a>
                        </div>
                        <div class="text-center">
                            <a class="inline-block text-sm text-cyan-500 hover:text-cyan-700" href="login.php">
                                Already have an account? Login!
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    document.getElementById('registerForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const firstName = document.getElementById('firstName').value.trim();
        const lastName = document.getElementById('lastName').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('c_password').value;

        const nameRegex = /^[A-Za-z]{2,}$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;

        let isValid = true;

        document.getElementById('errorFirstName').textContent = '';
        document.getElementById('errorLastName').textContent = '';
        document.getElementById('errorEmail').textContent = '';
        document.getElementById('errorPassword').textContent = '';
        document.getElementById('errorCPassword').textContent = '';

        if (!nameRegex.test(firstName)) {
            document.getElementById('errorFirstName').textContent = 'First name must contain at least 2 letters and no numbers.';
            isValid = false;
        }

        if (!nameRegex.test(lastName)) {
            document.getElementById('errorLastName').textContent = 'Last name must contain at least 2 letters and no numbers.';
            isValid = false;
        }

        if (!emailRegex.test(email)) {
            document.getElementById('errorEmail').textContent = 'Please enter a valid email address.';
            isValid = false;
        }

        if (!passwordRegex.test(password)) {
            document.getElementById('errorPassword').textContent = 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.';
            isValid = false;
        }

        if (password !== confirmPassword) {
            document.getElementById('errorCPassword').textContent = 'Passwords do not match.';
            isValid = false;
        }

        if (isValid) {
            alert('Form submitted successfully!');
        }
    });
</script> -->

</body>
</html>
