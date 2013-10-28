#!/usr/bin/env python
# -*- coding: utf-8 -*-

from sqlalchemy import select
from engine import *

conn = engine.connect()

s = select([users])
result = conn.execute(s)

for row in result:
    print row
    
result.close()

s = select([users, addresses]).where(users.c.id == addresses.c.user_id)

for row in conn.execute(s):
    print row  
