<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

<xsl:template match="previsions">
    <xsl:apply-templates select="echeance"/>
</xsl:template>

<xsl:template match="echeance">
    <div>
    <xsl:if test="@hour &lt; 27">
        <xsl:value-of select="@hour - 3"/>-<xsl:value-of select="@hour"/>h :
        <xsl:apply-templates select="temperature"/>
    </xsl:if>
    </div>
</xsl:template>

<xsl:template match="temperature">
    <xsl:apply-templates select="level"/>
</xsl:template>

<xsl:template match="level">
    <xsl:if test="@val='sol'">
        <xsl:variable name="temp" select="."/>
        <xsl:value-of select="round($temp - 273.15)"/>°C.
    </xsl:if>   
</xsl:template>

</xsl:stylesheet>