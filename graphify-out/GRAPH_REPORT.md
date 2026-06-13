# Graph Report - renova-2  (2026-06-13)

## Corpus Check
- 9 files · ~39,105 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 33 nodes · 27 edges · 6 communities (4 shown, 2 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `45c7eea9`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- [[_COMMUNITY_Community 0|Community 0]]
- [[_COMMUNITY_Community 1|Community 1]]
- [[_COMMUNITY_Community 2|Community 2]]
- [[_COMMUNITY_Community 3|Community 3]]

## God Nodes (most connected - your core abstractions)
1. `cursorDot` - 1 edges
2. `cursorRing` - 1 edges
3. `navbar` - 1 edges
4. `sections` - 1 edges
5. `navLinks` - 1 edges
6. `Validate` - 1 edges
7. `graphify` - 1 edges
8. `Renova Marketing Solutions` - 1 edges
9. `**Homepage**` - 1 edges
10. `**About Us**` - 1 edges

## Surprising Connections (you probably didn't know these)
- None detected - all connections are within the same source files.

## Import Cycles
- None detected.

## Communities (6 total, 2 thin omitted)

### Community 0 - "Community 0"
Cohesion: 0.10
Nodes (19): **About Us**, **Android App Development**, **Brand & Corporate Photography**, **Contact Us**, **Digital Billboard Advertising**, **Frequently Asked Questions**, **Graphic Design & Branding**, **Homepage** (+11 more)

### Community 1 - "Community 1"
Cohesion: 0.29
Nodes (5): cursorDot, cursorRing, navbar, navLinks, sections

## Knowledge Gaps
- **26 isolated node(s):** `cursorDot`, `cursorRing`, `navbar`, `sections`, `navLinks` (+21 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **2 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **What connects `cursorDot`, `cursorRing`, `navbar` to the rest of the system?**
  _26 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Community 0` be split into smaller, more focused modules?**
  _Cohesion score 0.1 - nodes in this community are weakly interconnected._