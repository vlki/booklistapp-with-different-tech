# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models

class Book(models.Model):
    title = models.CharField(max_length=255)

    class Meta:
        db_table = '"books"'

    def __str__(self):
        return str(self.id) + '-' + self.title
