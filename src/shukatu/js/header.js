document.write("URL:"+location.href);

const header_top_button = document.getElementById('header_top_button');
const header_howToUse_button = document.getElementById('howToUse_button');
const header_cartIn_button = document.getElementById('header_cartIn_button');
const header_QA_button = document.getElementById("header_QA_button");

if(location.href === "http://localhost:83/shukatu/user_page/user_agent_list.php") {
    console.log('a');
};

if(location.href == "http://localhost:83/shukatu/user_page/user_howToUse.php") {
    console.log('b');
};

if(location.href == "http://localhost:83/shukatu/user_page/user_cartlook.php") {
    console.log('c');
};