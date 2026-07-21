#!/bin/bash
set -euo pipefail

# Only run in remote (Claude Code on the web) environments
if [ "${CLAUDE_CODE_REMOTE:-}" != "true" ]; then
  exit 0
fi

echo "==> Setting up SEO audit environment..."

# Verify Python 3 is available (required for seo_check.py)
if ! command -v python3 &> /dev/null; then
  echo "ERROR: python3 not found. Please ensure Python 3 is installed." >&2
  exit 1
fi
echo "  python3: $(python3 --version)"

# Make the SEO audit script executable
SEO_SCRIPT="$CLAUDE_PROJECT_DIR/.claude/skills/seo-audit/scripts/seo_check.py"
if [ -f "$SEO_SCRIPT" ]; then
  chmod +x "$SEO_SCRIPT"
  echo "  seo_check.py: ready"
fi

echo "==> Environment ready."
