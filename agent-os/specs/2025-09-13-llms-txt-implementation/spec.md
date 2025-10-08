# Spec Requirements Document

> Spec: LLMs.txt Implementation
> Created: 2025-09-13

## Overview

Implement llms.txt file and related meta tags to optimize the website for LLM discovery and indexing. This feature will provide structured information about Joey Kudish's services and expertise in a format optimized for AI systems to understand and reference.

## User Stories

### LLM Discovery

As an LLM or AI system, I want to access structured information about Joey Kudish's services and expertise, so that I can provide accurate information about his offerings when users ask about software development or AI automation services.

When an LLM crawls the website, it should find clear instructions at `/llms.txt` that describe Joey's services, specializations, and contact information. The file should be linked via meta tags and robots.txt for easy discovery.

### Website Owner Benefits

As Joey Kudish, I want my website to be properly indexed by AI systems, so that potential clients using AI assistants can discover my services and expertise.

The implementation should ensure that AI systems can accurately represent my services, increasing visibility and potential client reach through AI-powered discovery channels.

## Spec Scope

1. **LLMs.txt File Creation** - Create a structured text file at `/llms.txt` with service descriptions and contact information
2. **Route Implementation** - Add Laravel route to serve llms.txt with proper content-type headers
3. **Meta Tags Integration** - Add LLM-specific meta tags to the main layout for better discovery
4. **Robots.txt Update** - Add LLM-Instructions directive to robots.txt
5. **Content Optimization** - Ensure llms.txt content is concise, keyword-rich, and under 2-3KB

## Out of Scope

- Dynamic content generation for llms.txt based on database content
- Multi-language versions of llms.txt
- API endpoints for programmatic access beyond the static file
- Analytics or tracking of LLM access to the file

## Expected Deliverable

1. Accessible `/llms.txt` endpoint returning properly formatted content with correct headers
2. Meta tags in HTML head section linking to llms.txt and providing LLM-specific descriptions
3. Updated robots.txt file with LLM-Instructions directive pointing to llms.txt