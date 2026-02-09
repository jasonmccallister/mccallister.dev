---
title: "Using AI Agents with Your Databases"
slug: "using-ai-agents-with-your-databases"
date: "2025-06-04"
readingTime: "2 min read"
featured: true
featuredImage: "/images/CleanShot-2025-06-05-at-10.26.05@2x.png"
description: "Learn how to build AI-powered workflows with Dagger that can query databases using natural language."
tags: ["ai", "dagger", "databases"]
---

Dagger represents a powerful tool for converting intricate configuration files
and fragile shell scripts into dependable, maintainable code. By leveraging
containers and isolated environments, Dagger empowers developers to incorporate
sophisticated business logic into workflows, access additional libraries, and
reliably deploy code.

Dagger recently introduced built-in support for Large Language Models,
broadening its functionality to streamline workflows. This capability enables
developers to construct intelligent, AI-powered workflows directly within their
deployment pipelines using consistent tooling.

## Key Benefits of AI Agents with Dagger

### Seamless LLM Integration

Dagger's LLM primitive enables switching between providers like OpenAI,
Anthropic, and Gemini through environment variables without code modifications.

### Built-in Observability

OpenTelemetry support provides comprehensive pipeline visibility. Tools like
Dagger Cloud and the Terminal User Interface deliver real-time insights into
each workflow stage.

### Secure, Sandboxed Environments

Container-based execution ensures LLMs access only explicitly granted resources,
enhancing security and workflow predictability.

### Modular and Reusable Workflows

Dagger encourages building complex workflows from simpler, reusable components,
promoting team collaboration and scalability.

## Getting Started with AI Agents in Dagger

1. Install Dagger CLI on your system
2. Initialize a Dagger Module using `dagger init` with preferred SDK
3. Configure LLM provider through environment variables
4. Develop agent functions utilizing Dagger's LLM and Env primitives
5. Execute and refine through observability tools

## Demo: Natural Language Database Queries

Integrating AI directly into workflows enables intelligent, secure, observable
pipelines suitable for code generation, testing, and deployment automation.

<iframe src="https://www.youtube.com/embed/LzHE0QTkQsM?si=4EGIL5Gn0hsP105m" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>