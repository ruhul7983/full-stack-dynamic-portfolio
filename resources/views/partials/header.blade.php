<style>
  
    .navbar{
        display: flex;
        justify-content:space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position:fixed;
        top: 0;
        left:0;
        right:0;
        z-index:50;
        background-color: white;
        padding: 0px 20px 0px 20px;
        
    }
    .name{
        font-weight: bold;
        font-size: 20px;
    }
    .name:hover{
        color: gray;
    }
    ul{
        display: flex;
        list-style: none;
        gap: 50px;
    }
    ul a{
        text-decoration: none;
        color:black;
    }
    ul a:hover{
        text-decoration: underline;
        color: blue;
    }

</style>

<nav class="navbar">
    <p class="name">
        Ruhul Amin
    </p>

    <ul>
        <a href="#"><li>Home</li></a>
        <a href="#"><li>About</li></a>
        <a href="#"><li>Project</li></a>
        <a href="#"><li>Contact</li></a>
    </ul>
</nav>