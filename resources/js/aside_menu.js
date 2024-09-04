
const hamBurger = document.querySelector(".toggle-btn");

const status = statusSidebar();

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
  localStorage.setItem("sidebarStatus", !status);
});

function statusSidebar() {
  const sidebarStatus = localStorage.getItem("sidebarStatus");

  if (sidebarStatus == null) {
    localStorage.setItem("sidebarStatus", false);
    return false;
  }

  const isExpanded = sidebarStatus === "true";

  if (isExpanded) {
    document.querySelector("#sidebar").classList.add("expand");
  } else {
    document.querySelector("#sidebar").classList.remove("expand");
  }


  return isExpanded;
}