---
title: "Switching to Fish shell on macOS"
slug: "switching-to-fish-shell-on-macos"
date: "2025-07-22"
readingTime: "3 min read"
featured: true
featuredImage: "/images/CleanShot-2025-07-22-at-10.51.34@2x-1.png"
description: "Install Fish on macOS, set it as your login shell, and recover if chsh goes wrong."
tags: ["shell", "macos", "fish"]
---

I switched from zsh to Fish after Mitchell Hashimoto talked about it on the Fallthrough Podcast while working on Ghostty.

## Why Fish

A few things sold me:

### Web config

`fish_config` opens a browser UI for themes, prompts, and variables. Easier than poking at config files for every tweak.

### Syntax highlighting as you type

Invalid commands turn red while you're still typing. That alone cuts a lot of silly typos.

### Private mode

You can run a session that doesn't keep history. Handy for demos where you don't want noise in your shell history afterward.

## Install

With Homebrew:

```bash
brew install fish
```

Check the path:

```bash
type fish
```

You should see `/opt/homebrew/bin/fish` on Apple Silicon.

## Change the default shell

Try:

```bash
chsh -s /opt/homebrew/bin/fish
```

macOS often rejects that with a "non-standard shell" message. Add Fish to `/etc/shells` first:

```bash
sudo sh -c 'echo /opt/homebrew/bin/fish >> /etc/shells'
```

Then run `chsh` again.

## If you lock yourself out

If the login shell path is wrong, fix it in System Settings:

1. Open Settings
2. Search for "Users & Groups"
3. Control-click your user photo
4. Choose Advanced Settings
5. Set Login shell back to something safe (like `/bin/zsh`)

That gets you a terminal again without digging through recovery tools.
