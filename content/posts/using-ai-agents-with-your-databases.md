---
title: "Using AI agents with your databases"
slug: "using-ai-agents-with-your-databases"
date: "2025-06-04"
readingTime: "2 min read"
featured: true
featuredImage: "/images/CleanShot-2025-06-05-at-10.26.05@2x.png"
description: "Build Dagger workflows that query databases with natural language."
tags: ["ai", "dagger", "databases"]
---

[Dagger](https://dagger.io) turns messy config and brittle shell scripts into regular code. It runs that code in containers, so you can pull in libraries, keep environments isolated, and ship the same pipeline everywhere.

Dagger also has built-in LLM support. You can put model calls in the same pipeline tooling you already use for builds and deploys.

## Why this helps

### Swap LLM providers without rewrites

The LLM primitive talks to OpenAI, Anthropic, Gemini, and similar providers. You pick the provider with environment variables, not code changes.

### See what the pipeline did

OpenTelemetry is wired in. Dagger Cloud and the terminal UI show each stage as it runs, which matters when an agent is calling tools you can't eyeball easily.

### Keep the model in a sandbox

The agent only sees what you mount into the container. That keeps credentials and files scoped to what you meant to share.

### Reuse the pieces

You build small functions and compose them. Teammates can reuse the same modules instead of copying scripts.

## Getting started

1. Install the Dagger CLI
2. Run `dagger init` with the SDK you want
3. Set the LLM provider env vars
4. Write agent functions with Dagger's LLM and Env primitives
5. Run the pipeline and watch it in the TUI or Dagger Cloud

## Demo: natural language database queries

Here's a short demo of asking a database questions in plain English from a Dagger workflow:

<iframe src="https://www.youtube.com/embed/LzHE0QTkQsM?si=4EGIL5Gn0hsP105m" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
