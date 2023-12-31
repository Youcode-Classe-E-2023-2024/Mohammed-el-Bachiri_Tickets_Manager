<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
    header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
    <style>
        /* Webkit (Chrome, Safari) */
        ::-webkit-scrollbar {
            width: 0px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- component -->
<nav class="bg-white w-full flex relative justify-between items-center mx-auto px-8 h-20">
    <!-- logo -->
    <div class="inline-flex">
        <a class="_o6689fn" href="../index.php"
            ><div class="hidden md:block">
                <img src="../img/logo.png" class="h-8" alt="">
            </div>
            <div class="block md:hidden">
                <svg width="30" height="32" fill="currentcolor" style="display: block">
                    <path d="M29.24 22.68c-.16-.39-.31-.8-.47-1.15l-.74-1.67-.03-.03c-2.2-4.8-4.55-9.68-7.04-14.48l-.1-.2c-.25-.47-.5-.99-.76-1.47-.32-.57-.63-1.18-1.14-1.76a5.3 5.3 0 00-8.2 0c-.47.58-.82 1.19-1.14 1.76-.25.52-.5 1.03-.76 1.5l-.1.2c-2.45 4.8-4.84 9.68-7.04 14.48l-.06.06c-.22.52-.48 1.06-.73 1.64-.16.35-.32.73-.48 1.15a6.8 6.8 0 007.2 9.23 8.38 8.38 0 003.18-1.1c1.3-.73 2.55-1.79 3.95-3.32 1.4 1.53 2.68 2.59 3.95 3.33A8.38 8.38 0 0022.75 32a6.79 6.79 0 006.75-5.83 5.94 5.94 0 00-.26-3.5zm-14.36 1.66c-1.72-2.2-2.84-4.22-3.22-5.95a5.2 5.2 0 01-.1-1.96c.07-.51.26-.96.52-1.34.6-.87 1.65-1.41 2.8-1.41a3.3 3.3 0 012.8 1.4c.26.4.45.84.51 1.35.1.58.06 1.25-.1 1.96-.38 1.7-1.5 3.74-3.21 5.95zm12.74 1.48a4.76 4.76 0 01-2.9 3.75c-.76.32-1.6.41-2.42.32-.8-.1-1.6-.36-2.42-.84a15.64 15.64 0 01-3.63-3.1c2.1-2.6 3.37-4.97 3.85-7.08.23-1 .26-1.9.16-2.73a5.53 5.53 0 00-.86-2.2 5.36 5.36 0 00-4.49-2.28c-1.85 0-3.5.86-4.5 2.27a5.18 5.18 0 00-.85 2.21c-.13.84-.1 1.77.16 2.73.48 2.11 1.78 4.51 3.85 7.1a14.33 14.33 0 01-3.63 3.12c-.83.48-1.62.73-2.42.83a4.76 4.76 0 01-5.32-4.07c-.1-.8-.03-1.6.29-2.5.1-.32.25-.64.41-1.02.22-.52.48-1.06.73-1.6l.04-.07c2.16-4.77 4.52-9.64 6.97-14.41l.1-.2c.25-.48.5-.99.76-1.47.26-.51.54-1 .9-1.4a3.32 3.32 0 015.09 0c.35.4.64.89.9 1.4.25.48.5 1 .76 1.47l.1.2c2.44 4.77 4.8 9.64 7 14.41l.03.03c.26.52.48 1.1.73 1.6.16.39.32.7.42 1.03.19.9.29 1.7.19 2.5z"></path>
                </svg>
            </div>
        </a>
    </div>

    <!-- end logo -->

    <!-- search bar -->
    <div class="hidden sm:block flex-shrink flex-grow-0 justify-start px-2">
        <div class="inline-block">
            <div class="inline-flex items-center max-w-full">
                <button class="flex items-center flex-grow-0 flex-shrink pl-2 relative w-60 border rounded-full px-1  py-1" type="button">
                    <input class="block flex-grow flex-shrink overflow-hidden outline-none px-2" placeholder="search a ticket"/>
                    <div>&#128269;</div>
                </button>
            </div>
        </div>
    </div>
    <!-- end search bar -->

    <!-- login -->
    <div class="flex-initial">
      <div class="flex justify-end items-center relative">

        <div class="flex mr-4 items-center">
            <div class="ml-4 hover:text-gray-400 transition-all flex inline-block py-2 px-3  items-center  bg-gray-200 rounded-full cursor-pointer">My Tickets</div>
            <div class="ml-4 hover:text-gray-400 transition-all flex inline-block py-2 px-3  items-center shadow-lg bg-gray-200 rounded-full cursor-pointer">Assignments</div>
            <div class="ml-4 hover:text-gray-400 transition-all flex inline-block py-2 px-3  items-center shadow-lg bg-gray-200 rounded-full cursor-pointer">All Tickets</div>
          <div class="block relative">
            <button type="button" class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full relative ">
              <div class="flex items-center h-5">
                <div class="_xpkakx">
                  <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" style="display: block; height: 16px; width: 16px; fill: currentcolor;"><path d="m8.002.25a7.77 7.77 0 0 1 7.748 7.776 7.75 7.75 0 0 1 -7.521 7.72l-.246.004a7.75 7.75 0 0 1 -7.73-7.513l-.003-.245a7.75 7.75 0 0 1 7.752-7.742zm1.949 8.5h-3.903c.155 2.897 1.176 5.343 1.886 5.493l.068.007c.68-.002 1.72-2.365 1.932-5.23zm4.255 0h-2.752c-.091 1.96-.53 3.783-1.188 5.076a6.257 6.257 0 0 0 3.905-4.829zm-9.661 0h-2.75a6.257 6.257 0 0 0 3.934 5.075c-.615-1.208-1.036-2.875-1.162-4.686l-.022-.39zm1.188-6.576-.115.046a6.257 6.257 0 0 0 -3.823 5.03h2.75c.085-1.83.471-3.54 1.059-4.81zm2.262-.424c-.702.002-1.784 2.512-1.947 5.5h3.904c-.156-2.903-1.178-5.343-1.892-5.494l-.065-.007zm2.28.432.023.05c.643 1.288 1.069 3.084 1.157 5.018h2.748a6.275 6.275 0 0 0 -3.929-5.068z"></path></svg>
                </div>
              </div>
            </button>
          </div>
        </div>

        <div class="block">
            <div class="inline relative">
                <button id="btnMenu" type="button" class="inline-flex items-center relative pl-2 border rounded-full hover:shadow-lg">
                    <div class="pl-1" id="d1" style="transition: .4s;">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;">
                            <g fill="none" fill-rule="nonzero">
                                <path d="m2 16h28"></path>
                                <path d="m2 24h28"></path>
                                <path d="m2 8h28"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="flex pl-2 h-10" id="btnMenu">
                        <img src="../img/<?=$currentUserData['imagePath']?>" alt="" class="rounded-full shadow-xl">
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- end login -->
</nav>

<div class="formbold-main-wrapper">
    <div class="formbold-form-wrapper" id="">
        <div class="formbold-input-group">
            <label for="name" class="formbold-form-label"> Title </label>
            <input type="text" id="title" placeholder="Enter title of the Ticket" class="ticketInput formbold-form-input"/>
        </div>

        <div>
            <label for="message" class="formbold-form-label">
                Description
            </label>
            <textarea rows="6" id="description" placeholder="Enter Description of the Ticket..." class="ticketInput formbold-form-input"></textarea>
        </div>
        <div class="flex justify-between border my-4 p-4 items-center">
            <div class="flex">
                <p class="ticketInput text-purple-400 mr-4">Status</p>
                <select id="status" class="ticketInput" id="">
                    <option value="To Do">To Do</option>
                    <option value="Doing">Doing</option>
                    <option value="Done">Done</option>
                </select>
            </div>
            <div class="flex">
                <p class="ticketInput text-purple-400 mr-4">Priorety</p>
                <select name="priorety" class="ticketInput" id="priority">
                    <option value="Importent">Importent</option>
                    <option value="Not Importent">Not Importent</option>
                    <option value="Very Importent">Very Importent</option>
                </select>
            </div>
        </div>


        <div class="border">
            <div class="flex justify-between items-center">
                <p class="pl-4 ticketInput text-purple-400 w-fit">Tags</p>
                <select id="tags" name="tag">
                    <!-- display tags in here ! -->
                </select>
                <div>
                    <input id="addTagInput" type="text" class=" p-4 outline-none w-32 " placeholder="Add Tag">
                    <button id="addTagButton" class="border-2 hover:bg-purple-300 p-4">Add</button>
                </div>
            </div>
        </div>
        
        
        <div class="border mt-4 p-2">
            <p class="pl-4 ticketInput text-purple-400 w-fit my-2">Assign this Ticket to </p>
            <select name="" id="usersToAssign" class="displayUsers mx-2 w-full outline-none shadow-xl p-4 rounded-xl"  multiple>
                <!-- display users here  -->
            </select>
        </div>

        <button value="<?= $_SESSION['userId'] ?>" id="submitTicket" class="formbold-btn">Submit</button>
    </div>
</div>

<form id="menu" class="shadow-xl m-2 p-3 absolute bg-white rounded-xl right-6" style="top: -15px; z-index: -1;" action="../controllers/User/LogOut.php" method="post">
    <p>Profile</p>
    <button class="text-red-300">Log Out</button>
</form>

<div id="succAdd" style="transition: .6s;" class="bg-gradient-to-l from-indigo-500 opacity-0 absolute top-20 bg-green-400 text-white w-fit m-2 p-4 rounded-sm">
    Ticket Add Succ !
</div>
<div id="failAdd" style="transition: .6s;" class="bg-gradient-to-l from-red-500 opacity-0 absolute top-20 bg-red-900 text-white w-fit m-2 p-4 rounded-sm">
    You Must Fill All The Inputs !
</div>
    <script src="../js/AddTagAjax.js"></script>
    <script src="../js/AddTicketAjax.js"></script>
    <script src="../js/DisplayUsers.js"></script>
</body>
</html>

