document.write("URL:"+location.href);

const header_top_button = document.getElementById('header_top_button');
const header_how_to_use_button = document.getElementById('header_how_to_use_button');
const header_cartIn_button = document.getElementById('header_cartIn_button');

if(location.href === "http://localhost:83/shukatu/user_page/user_agent_list.php") {
    header_top_button.style.opacity = "1";
    header_how_to_use_button.style.opacity = "0.5";
    header_cartIn_button.style.opacity = "0.5";
};

if(location.href == "http://localhost:83/shukatu/user_page/user_howToUse.html") {
    header_top_button.style.opacity = "0.5";
    header_how_to_use_button.style.opacity = "1";
    header_cartIn_button.style.opacity = "0.5";
};

if(location.href == "http://localhost:83/shukatu/user_page/user_cartlook.php") {
    header_top_button.style.opacity = "0.5";
    header_howToUse_button.style.opacity = "0.5";
    header_cartIn_button.style.opacity = "1";
};

