# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django import forms

class CreateBookForm(forms.Form):
    title = forms.CharField(max_length=255)
