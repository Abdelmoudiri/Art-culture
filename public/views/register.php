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
    <!-- Container -->
    <div class="mx-auto">
        <div class="flex justify-center px-6 py-6">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                <!-- Col -->
                <div class="w-full h-auto hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
                     style="background-image: url('https://images.unsplash.com/photo-1735406818183-a1162c38e6e2?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                </div>
                <!-- Col -->
                <div class="w-full lg:w-7/12 bg-white p-5 sm:rounded-3xl rounded-lg lg:rounded-l-none shadow-lg">
                    <h3 class="py-4 text-2xl text-center text-gray-800">Create an Account!</h3>
                    <form class="px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                                    First Name
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border-b-2 border-gray-300 focus:outline-none focus:border-cyan-500"
                                    id="firstName" type="text" placeholder="First Name"/>
                            </div>
                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="lastName">
                                    Last Name
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border-b-2 border-gray-300 focus:outline-none focus:border-cyan-500"
                                    id="lastName" type="text" placeholder="Last Name"/>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                Email
                            </label>
                            <input
                                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border-b-2 border-gray-300 focus:outline-none focus:border-cyan-500"
                                id="email" type="email" placeholder="Email"/>
                        </div>
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                    Password
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border-b-2 border-gray-300 focus:outline-none focus:border-cyan-500"
                                    id="password" type="password" placeholder="******************"/>
                            </div>
                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="c_password">
                                    Confirm Password
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border-b-2 border-gray-300 focus:outline-none focus:border-cyan-500"
                                    id="c_password" type="password" placeholder="******************"/>
                            </div>
                        </div>
                        <div class="mb-6 text-center">
                            <button
                                class="w-full px-4 py-2 font-bold text-white bg-cyan-500 rounded-full hover:bg-cyan-600 focus:outline-none focus:shadow-outline"
                                type="button">
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
                            <a class="inline-block text-sm text-cyan-500 hover:text-cyan-700" href="index.php?action=login">
                                Already have an account? Login!
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
