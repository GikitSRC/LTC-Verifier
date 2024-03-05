document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("loading").style.display = "flex";
  setTimeout(function() {
    document.getElementById("loading").style.opacity = "0";
    document.getElementById("content").style.display = "block";
    setTimeout(function() {
      document.getElementById("loading").style.display = "none";
    }, 1000); 
  }, 3000); 
});

console.log(`
            .##.....##.####.####
            .##.....##..##..####
            .##.....##..##..####
            .#########..##...##.
            .##.....##..##......
            .##.....##..##..####
            .##.....##.####.####

Opened up the console... but why?

Hacker? Don't even try. Multiple security features has already been implemented.

Curious on the source code? It's open source! Find it on my profile (Well, the guy hired to make this website's portfolio) here: https://chainedtears.dev

Of course, the security implementions are included in the source code. Please be a nice guy and if you find any bugs, glitches or security issues, or anything that allows unauthorized access to the paywalled product, please don't abuse and report them to me.

Extreme measures were taken to make sure your payment goes through securely and everything :) 

If you've landed here on accident, please don't panic. Just close the Developer tools page and go back!

            `);

console.log("Just kidding... zero security features were implemented cuz idk how but u can try if you want ig");
