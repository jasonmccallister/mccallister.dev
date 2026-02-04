---
title: "Switching to Fish Shell on macOS"
slug: "switching-to-fish-shell-on-macos"
date: "2025-07-22"
readingTime: "3 min read"
featured: true
featuredImage: "/images/CleanShot-2025-07-22-at-10.51.34@2x-1.png"
description: "A guide to transitioning from ZSH to Fish Shell on macOS, covering installation, configuration, and recovery tips."
tags: ["shell", "macos", "fish"]
---

I recently made the switch from ZSH to Fish Shell after hearing Mitchell
Hashimoto discuss it on the Fallthrough Podcast regarding Ghostty terminal
development.

## Why Fish Shell?

Three key features motivated this change:

### 1. Web-based Configuration Interface

The built-in `fish_config` command launches a web UI for managing themes,
prompts, and variables, making customization accessible regardless of technical
experience level.

### 2. Syntax Highlighting Feedback

As users type commands and navigate directories, Fish provides immediate visual
feedback, displaying invalid commands in red by default.

### 3. Private Mode Functionality

This feature prevents command history from being retained during specific
sessions, proving valuable for demonstrations and tutorials where
reproducibility matters.

## Installation Process

Using Homebrew, installation requires:

```bash
brew install fish
```

Verification uses:

```bash
type fish
```

Expected output: `/opt/homebrew/bin/fish`

## Changing Default Shell

The standard command is:

```bash
chsh -s /opt/homebrew/bin/fish
```

However, macOS security restrictions typically produce a "non-standard shell"
message. To resolve this, add Fish to the allowed shells list:

```bash
sudo sh -c 'echo /opt/homebrew/bin/fish >> /etc/shells'
```

Then retry the shell change command.

## Recovering from Shell Configuration Errors

If an incorrect path is set, macOS provides a recovery option through System
Settings:

1. Open Settings
2. Search for "Users & Groups"
3. Control-click your user photo
4. Select "Advanced Settings"
5. Modify the Login shell setting back to the default shell

This hidden feature allows terminal access restoration without requiring
system-level intervention.
