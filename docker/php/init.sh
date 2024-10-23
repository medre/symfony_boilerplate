#!/bin/sh

# Your custom initialization commands go here
echo "Running initialization steps..."

exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
